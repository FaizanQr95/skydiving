<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use App\Models\UserAwarded;
use App\Models\UserReferral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // ✅ 1. Register: Send OTP only (Check for existing email/phone first)
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone_number' => 'required',
            'name' => 'required',
            'password' => 'required|min:6',
            'invited_by' => 'nullable|string'
        ]);

        $email = $request->email;
        $phone = $request->phone_number;

        // Check local DB for duplicate email or phone
        $existingUser = User::where('email', $email)
            ->orWhere('phone_number', $phone)
            ->first();

        if ($existingUser) {
            $field = $existingUser->email === $email ? 'email' : 'phone number';
            return response()->json(['message' => "User with this $field already exists"], 409);
        }

        // Check Square for duplicates
        $squareToken = env('SQUARE_SANDBOX_TOKEN');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $squareToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get('https://connect.squareupsandbox.com/v2/customers');

        if ($response->failed()) {
            return response()->json(['message' => 'Failed to connect to Square'], 500);
        }

        $customers = $response->json()['customers'] ?? [];

        foreach ($customers as $customer) {
            if (($customer['email_address'] ?? '') === $email) {
                return response()->json(['message' => 'User with this email already exists'], 409);
            }

            if (($customer['phone_number'] ?? '') === $phone) {
                return response()->json(['message' => 'User with this phone number already exists'], 409);
            }
        }

        // Generate ref_id and prepare referral logic
        $ref_id = 'ref-' . rand(100000, 999999);
        $invited_by = $request->invited_by ?? null;

        $user = User::create([
            'square_user_id' => '',
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'phone_number' => $phone,
            'ref_id' => $ref_id,
            'invited_ref_ids' => json_encode([]),
        ]);

        $note = 'Invited Ref IDs: ' . json_encode([]);

        if ($invited_by) {
            $inviter = User::where('ref_id', $invited_by)->first();

            if ($inviter) {
                $invited = json_decode($inviter->invited_ref_ids, true);
                $invited[] = $ref_id;
                $inviter->invited_ref_ids = json_encode($invited);
                $inviter->save();

                $note = 'Invited Ref IDs: ' . json_encode($invited);

                UserReferral::create([
                    'user_id' => $user->id,
                    'referral_id' => $inviter->id,
                ]);
            }
        }

        // Create user in Square
        $squareCreate = Http::withHeaders([
            'Authorization' => 'Bearer ' . $squareToken,
            'Content-Type' => 'application/json',
        ])->post('https://connect.squareupsandbox.com/v2/customers', [
            'given_name' => $user->name,
            'email_address' => $user->email,
            'phone_number' => $user->phone_number,
            'reference_id' => $ref_id,
            'note' => $note,
        ]);

        if ($squareCreate->failed()) {
            $user->delete();
            return response()->json(['message' => 'Failed to create user in Square'], 500);
        }

        $user->square_user_id = $squareCreate->json()['customer']['id'];
        $user->save();

        // Generate Sanctum token
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user
        ]);
    }


    // ✅ 3. Login with email & password
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }

    // ✅ 4. Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful']);
    }


    // ✅ 6. Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find($request->user_id);

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }

//
    public function checkPhoneNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Phone number is required'], 422);
        }

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json(['message' => 'Phone number is not valid'], 404);
        }

        return response()->json([
            'message' => 'Phone number is valid',
            'user_id' => $user->id
        ]);
    }

    public function getUserReferralDetail(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $activeReferrals = $user->referrals()
            ->whereHas('referredUser', function ($q) {
                $q->where('status', 'active');
            })
            ->with('referredUser')
            ->get();

        // Map only active referrals
        $data = $activeReferrals->map(function ($referral) {
            return [
                'id' => $referral->id,
                'referred_name' => $referral->referredUser->name ?? null,
                'status' => $referral->status,
                'referral_date' => $referral->created_at->format('d-M-Y'),
            ];
        });

        return response()->json([
            'status' => true,
            'user_name' => $user->name,
            'user_phone' => $user->phone_number,
            'total_referrals' => $user->referrals()->count(),
            'active_referrals' => $activeReferrals->count(),
            'earned_points' => '0',
            'referrals' => $data->values(),
        ]);
    }

    public function userReward(Request $request)
    {
        $user = $request->user();

        $rewards = UserAwarded::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $rewards
        ]);
    }

}
