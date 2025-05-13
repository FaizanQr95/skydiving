<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Otp;
use App\Models\UserAwarded;
use App\Models\UserReferral;
use App\Services\CometChatService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SendSupportEmailRequest; // Your Form Request
use App\Mail\SupportRequestMail;            // Your Mailable
use Illuminate\Support\Facades\Mail;


class ApiController extends Controller
{
    protected $cometChatService;
    protected $adminUid = "1";

    public function __construct(CometChatService $cometChatService) // Inject the service
    {
        $this->cometChatService = $cometChatService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
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
            'name' => $request->first_name .' '. $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
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

        // Create user in CometChat
        $cometUser = $this->cometChatService->createUser(
            (string) $user->id, // UID
            $user->name,       // Name
            ['email' => $user->email] // Optional metadata
        );

        if ($cometUser) {
            Log::info("User created in CometChat successfully: UID " . ($cometUser['uid'] ?? 'N/A'));
        } else {
            Log::error("Failed to create user in CometChat: UID " . $user->id);
            // You might want to handle this failure, e.g., queue a retry
        }

        // Create user in Square
        $squareCreate = Http::withHeaders([
            'Authorization' => 'Bearer ' . $squareToken,
            'Content-Type' => 'application/json',
        ])->post('https://connect.squareupsandbox.com/v2/customers', [
            'given_name' => $user->first_name,
            'family_name' => $user->last_name,
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

    // ✅ 1. Register: Send OTP only (Check for existing email/phone first)
    public function register_old(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
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
            'name' => $request->first_name .' '. $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
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

        // Create user in CometChat
        $cometUser = $this->cometChatService->createUser(
            (string) $user->id, // UID
            $user->name,       // Name
            ['email' => $user->email] // Optional metadata
        );

        if ($cometUser) {
            Log::info("User created in CometChat successfully: UID " . ($cometUser['uid'] ?? 'N/A'));
        } else {
            Log::error("Failed to create user in CometChat: UID " . $user->id);
            // You might want to handle this failure, e.g., queue a retry
        }

        // Create user in Square
        $squareCreate = Http::withHeaders([
            'Authorization' => 'Bearer ' . $squareToken,
            'Content-Type' => 'application/json',
        ])->post('https://connect.squareupsandbox.com/v2/customers', [
            'given_name' => $user->first_name,
            'family_name' => $user->last_name,
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

    public function login(Request $request)
    {
        Log::info('Login request received', ['email' => $request->email]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('User not found during login', ['email' => $request->email]);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Password mismatch for user', ['email' => $request->email]);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        try {
            $token = $user->createToken('mobile')->plainTextToken;
            Log::info('Token created successfully', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('Token creation failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Login failed'], 500);
        }

        Log::info('Login successful', ['user_id' => $user->id]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function profile(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);

        return response()->json([
            'message' => 'User found.',
            'user' => $user
        ]);
    }


    public function updateProfile(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If validation fails, return custom structured response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($request->user_id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars/' . $user->id, $filename, 'public');

            $user->avatar = $path;
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User profile updated successfully.',
            'data' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'avatar_url' => $user->avatar ? 'https://skydiverentalapp.com/storage/app/public/'.$user->avatar : null,
            ]
        ], 200);
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

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if user exists (though 'exists' rule already does this)
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Optionally, return a generic message to prevent email enumeration
            return response()->json(['message' => 'If your email address exists in our database, you will receive a password recovery link at your email address in a few minutes.'], 200);
        }

        // Send the password reset link
        // This uses the 'users' password broker defined in config/auth.php
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent successfully.'], 200);
        } elseif ($status == Password::INVALID_USER) {
            // This case should ideally be caught by the validator or earlier user check
            return response()->json(['message' => 'We can\'t find a user with that email address.'], 404);
        } else {
            // Other statuses like Password::RESET_THROTTLED
            return response()->json(['message' => 'Failed to send password reset link. Please try again later.'], 500);
        }
    }


    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8', // confirmed adds password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60)); // Optionally reset remember token

                $user->save();

                event(new PasswordReset($user)); // Fire event
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 400);
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
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            Log::info('Referral API called by user ID: ' . $user->id);

            $activeReferrals = $user->referrals()
                ->whereHas('referredUser', function ($q) {
                    $q->where('status', 'active');
                })
                ->with('referredUser')
                ->get();

            $data = $activeReferrals->map(function ($referral) {
                return [
                    'id' => $referral->id,
                    'referred_name' => optional($referral->referredUser)->name,
                    'status' => $referral->status,
                    'referral_date' => $referral->created_at->format('d-M-Y'),
                ];
            });

            return response()->json([
                'status' => true,
                'user_name' => $user->name,
                'user_phone' => $user->phone_number,
                'total_referrals' => $activeReferrals->count(),
                'active_referrals' => $activeReferrals->count(),
                'earned_points' => '0', // Replace with real logic if needed
                'referrals' => $data->values(),
            ]);
        } catch (\Exception $e) {
            Log::error('getUserReferralDetail Error: ', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while fetching referral details.',
            ], 500);
        }
    }

    public function userReward(Request $request)
    {
        try {
            $user = $request->user();

            Log::info('userReward API called by user ID: ' . $user->id);

            $rewards = UserAwarded::where('user_id', $user->id)->get();

            return response()->json([
                'success' => true,
                'data' => $rewards,
            ]);
        } catch (\Exception $e) {
            Log::error('userReward Error: ', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching rewards.',
            ], 500);
        }
    }



    //Delete User
    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete from Square if square_user_id exists
        if ($user->square_user_id) {
            $squareToken = env('SQUARE_SANDBOX_TOKEN');
            $squareResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $squareToken,
                'Accept' => 'application/json',
            ])->delete("https://connect.squareupsandbox.com/v2/customers/{$user->square_user_id}");

            if ($squareResponse->failed()) {
                return response()->json(['message' => 'Failed to delete user from Square'], 500);
            }
        }

        // Delete from Laravel DB
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function supportMail(SendSupportEmailRequest $request)
    {
        $validatedData = $request->validated();

        $userId = $validatedData['user_id'];
        $title = $validatedData['title'];
        $description = $validatedData['description'];
        $attachments = $request->hasFile('files') ? $request->file('files') : [];

        // Fetch the user
        $user = User::find($userId);

        // Although 'exists:users,id' rule in FormRequest should prevent user being null,
        // it's good practice for defensive programming or if you change validation later.
        if (!$user) {
            // This case should ideally be caught by the 'exists' validation rule.
            // If it somehow gets here, log it and decide how to proceed.
            // For now, we'll proceed but the Mailable will show "N/A".
            Log::warning("Support request submitted for non-existent user ID: {$userId} after validation. This should not happen.");
            // You could also return an error here if you prefer:
            // return response()->json(['message' => 'User not found.'], 404);
        }

        try {
            $recipientEmail = config('mail.support_recipient');

            if (!$recipientEmail || !filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
                Log::error('Support email recipient is not configured or invalid in config/mail.php.');
                return response()->json([
                    'message' => 'Support email recipient is not configured correctly. Please contact admin.',
                ], 500);
            }

            Mail::to($recipientEmail)
                ->send(new SupportRequestMail($title, $description, $user, $attachments)); // Pass the $user object

            return response()->json(['message' => 'Support email sent successfully.'], 200);

        } catch (\Exception $e) {
            Log::error('Failed to send support email: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'message' => 'Failed to send support email. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint for a user to send a message to the support admin.
     */
    public function userSendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:5000',
            'user_id' => 'required|exists:users,id',
            // 'custom_type' => 'sometimes|string', // For custom messages
            // 'custom_data' => 'sometimes|array',  // For custom messages
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $senderUid = (string) $user->id;
        $receiverUid = $this->adminUid; // Admin receives the message
        $textMessage = $request->input('message');

        $sentMessage = $this->cometChatService->sendTextMessage(
            $senderUid,
            $receiverUid,
            'user', // Receiver type is 'user' for one-on-one
            $textMessage
        );

        if ($sentMessage) {
            // The Flutter client should also receive this message in real-time via SDK listeners.
            // This API response is more for confirmation.
            return response()->json(['message' => 'Message sent successfully', 'data' => $sentMessage], 201);
        }

        return response()->json(['message' => 'Failed to send message'], 500);
    }

    /**
     * Endpoint for an admin to send a message to a specific user.
     * This would typically be used from an admin dashboard.
     * Ensure this endpoint is protected and only accessible by authenticated admins.
     */
    public function adminSendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_user_id' => 'required|integer|exists:users,id', // The target user's ID in your DB
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Authenticate admin (implement your admin auth logic if different from regular user auth)
        $adminUser = Admin::find(1); // Assuming admin logs in like a regular user for now
        if (!$adminUser || (string) $adminUser->id !== $this->adminUid) {
            return response()->json(['message' => 'Unauthorized: Not a support admin or invalid admin ID.'], 403);
        }

        $senderUid = $this->adminUid; // Admin is the sender
        $receiverUserAppId = $request->input('receiver_user_id');
        $receiverUid = (string) $receiverUserAppId; // Target user's UID in CometChat
        $textMessage = $request->input('message');

        $sentMessage = $this->cometChatService->sendTextMessage(
            $senderUid,
            $receiverUid,
            'user',
            $textMessage
        );

        if ($sentMessage) {
            return response()->json(['message' => 'Message sent successfully to user ' . $receiverUserAppId, 'data' => $sentMessage], 201);
        }

        return response()->json(['message' => 'Failed to send message to user ' . $receiverUserAppId], 500);
    }

    /**
     * Fetch message history between the authenticated user and the support admin.
     */
    public function getUserSupportMessages(Request $request)
    {
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $limit = $request->input('limit', 50);
        $beforeMessageId = $request->input('before_message_id'); // For pagination

        $userUid = (string) $user->id;

        // Fetch messages between userUid and adminUid
        // The order of userUid and adminUid might matter for the 'initiator' in getConversationMessages
        $messages = $this->cometChatService->getConversationMessages($userUid, $this->adminUid, $limit, $beforeMessageId);

        if ($messages !== null) { // Check for null because an empty array is a valid response
            return response()->json($messages);
        }

        return response()->json(['message' => 'Failed to fetch messages or no messages found.'], 404); // Or 500 if it's an error
    }

    /**
     * Fetch message history between a specific user and the support admin (for admin panel).
     * Ensure this endpoint is protected and only accessible by authenticated admins.
     */
    public function getAdminUserMessages(Request $request, $targetUserId)
    {
        // Authenticate admin
        $adminUser = Admin::find(1);
        if (!$adminUser || (string) $adminUser->id !== $this->adminUid) {
            return response()->json(['message' => 'Unauthorized: Not a support admin.'], 403);
        }

        $limit = $request->input('limit', 50);
        $beforeMessageId = $request->input('before_message_id');
        $targetUserUid = (string) $targetUserId;

        // Fetch messages between adminUid and targetUserUid
        $messages = $this->cometChatService->getConversationMessages($this->adminUid, $targetUserUid, $limit, $beforeMessageId);

        if ($messages !== null) {
            return response()->json($messages);
        }
        return response()->json(['message' => 'Failed to fetch messages or no messages found.'], 404);
    }
}
