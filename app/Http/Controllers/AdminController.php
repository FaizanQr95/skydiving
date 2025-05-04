<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAwarded;
use App\Models\UserReferral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Otherwise, show the login form
        return view('admin.login');
    }
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard', compact('admin', ));
    }


//    public function login(Request $request)
//    {
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::guard('admin')->attempt($credentials)) {
//            return redirect()->route('admin.dashboard');
//        }
//
//        return back()->with('error', 'Invalid credentials');
//    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // If authentication is successful, regenerate the session and redirect to dashboard
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

//    public  function userManagement(Request $request)
//    {
//        $user = User::get();
//        return view('admin.user_management',compact('user'));
//    }
    public function userManagement(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $users = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('admin.user_management', compact('users'));
    }

    public  function referralManagement(Request $request)
    {
        $userRef = UserReferral::with('user','referredUser')->get();
        return view('admin.referral_management',compact('userRef'));
    }

    public  function adminProfile(Request $request)
    {
        $admin = auth('admin')->user();

        return view('admin.profile',compact('admin'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|confirmed|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avi|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            // Optional: delete old image if exists
            if ($admin->image && \Storage::exists('public/' . $admin->image)) {
                \Storage::delete('public/' . $admin->image);
            }

            $imagePath = $request->file('image')->store('admin_images', 'public');
            $admin->image = $imagePath;
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function rewardManagement(Request $request){
        $rewardedIds = UserAwarded::pluck('user_id')->toArray();
        $rewardsData = UserAwarded::with('user')->get()->groupBy('user_id');
        $refApproved = UserReferral::where('status','approved')->get();
        return view('admin.reward_management',compact('refApproved','rewardedIds','rewardsData'));
    }
//    public function updateStatus(Request $request)
//    {
//        $referral = UserReferral::find($request->id);
//
//        if ($referral) {
//            $referral->status = $request->status;
//            $referral->save();
//
//            return response()->json(['success' => true]);
//        }
//
//        return response()->json(['success' => false]);
//    }
    public function updateStatus(Request $request)
    {
        \Log::info('Referral update request:', $request->all());

        $referral = UserReferral::find($request->id);

        if ($referral) {
            $referral->status = $request->status;
            $referral->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
//    public function fetchCustomer()
//    {
//
//        $squareToken = config('services.square.sandbox_token');
//
//        $response = Http::withHeaders([
//            'Authorization' => 'Bearer ' . $squareToken,
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/json',
//        ])->get('https://connect.squareupsandbox.com/v2/customers');
//
//        $customers = $response->successful()
//            ? collect($response->json()['customers'] ?? [])
//            : collect([]);
//
//        $perPage = 10;
//        $currentPage = LengthAwarePaginator::resolveCurrentPage();
//        $pagedData = $customers->slice(($currentPage - 1) * $perPage, $perPage)->values();
//
//        $paginated = new LengthAwarePaginator(
//            $pagedData,
//            $customers->count(),
//            $perPage,
//            $currentPage,
//            ['path' => request()->url(), 'query' => request()->query()]
//        );
//
//        return view('admin.fetch_customer', ['customers' => $paginated]);
//    }
    public function fetchCustomer()
    {
        $squareToken = config('services.square.sandbox_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $squareToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get('https://connect.squareupsandbox.com/v2/customers');

        $customers = $response->successful()
            ? collect($response->json()['customers'] ?? [])
            : collect([]);

        if (request()->filled('search')) {
            $search = strtolower(request('search'));

            $customers = $customers->filter(function ($customer) use ($search) {
                return str_contains(strtolower($customer['given_name'] ?? ''), $search)
                    || str_contains(strtolower($customer['family_name'] ?? ''), $search)
                    || str_contains(strtolower($customer['email_address'] ?? ''), $search)
                    || str_contains(strtolower($customer['phone_number'] ?? ''), $search);
            })->values();
        }

        if (request()->filled('status')) {
            $status = request('status');
            $customers = $customers->filter(function ($customer) use ($status) {
                return ($customer['status'] ?? '') === $status;
            })->values();
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedData = $customers->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $pagedData,
            $customers->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.fetch_customer', ['customers' => $paginated]);
    }


    public function assignReward(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $value = ($request->points * $request->discount) / 100;
        $expiryDate = now()->addDays(30);
        do {
            $couponCode = strtoupper(Str::random(8));
        } while (UserAwarded::where('coupon_code', $couponCode)->exists());

        UserAwarded::create([
            'coupon_code' => $couponCode,
            'user_id' => $request->user_id,
            'points' => $request->points,
            'discount' => $request->discount,
            'coupon_value' => $value,
            'expiry_date' => $expiryDate,
            'status' => 'active',
        ]);

        return back()->with('success', "Coupon '{$couponCode}' generated (Coupon value: {$value}).");
    }


    public function updateReward(Request $request)
    {
//        return $request->all();
        $request->validate([
//            'id' => 'required|exists:id',
            'points' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
        ]);
        $value = ($request->points * $request->discount) / 100;

        $reward = UserAwarded::findOrFail($request->id);
        $reward->points = $request->points;
        $reward->discount = $request->discount;
        $reward->coupon_value = $value;
        $reward->save();

        return back()->with('success', 'Reward updated successfully.');
    }

}

