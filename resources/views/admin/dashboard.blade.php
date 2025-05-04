{{--@extends('layouts.admin-master')--}}

{{--@section('title', 'Admin Dashboard')--}}

{{--@section('content')--}}
{{--    <h1>Welcome, Admin!</h1>--}}
{{--    <p>This is your dashboard.</p>--}}

{{--    <form action="{{ route('admin.logout') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <button type="submit">Logout</button>--}}
{{--    </form>--}}
{{--@endsection--}}
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Dashboard</title>--}}
{{--</head>--}}
{{--<body style="font-family: Arial, sans-serif; margin: 0; background-color: #1c1c1e; color: white;">--}}

{{--<div style="display: flex;">--}}
{{--    <!-- Sidebar -->--}}
{{--    <div style="width: 250px; background-color: #232323; padding: 20px;">--}}
{{--        <h2 style="color: #e0e0e0;">Skydiving</h2>--}}
{{--        <ul style="list-style-type: none; padding: 0;">--}}
{{--            <li style="padding: 10px 0;">--}}
{{--                <a href="#" style="text-decoration: none; color: #b0ff1a;">Dashboard</a>--}}
{{--            </li>--}}
{{--            <li style="padding: 10px 0;">--}}
{{--                <a href="#" style="text-decoration: none; color: #b0ff1a;">User Management</a>--}}
{{--            </li>--}}
{{--            <li style="padding: 10px 0;">--}}
{{--                <a href="#" style="text-decoration: none; color: #b0ff1a;">Rewards Management</a>--}}
{{--            </li>--}}
{{--            <li style="padding: 10px 0;">--}}
{{--                <a href="#" style="text-decoration: none; color: #b0ff1a;">Settings</a>--}}
{{--            </li>--}}
{{--            <li style="padding: 10px 0;">--}}
{{--                <a href="#" style="text-decoration: none; color: #b0ff1a;">Notifications</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div style="margin-top: 50px;">--}}
{{--            <span style="display: block; margin-bottom: 10px;">Jadon Bator</span>--}}
{{--            <a href="#" style="text-decoration: none; background-color: #ff3b30; color: white; padding: 10px; display: inline-block; border-radius: 4px;">Logout</a>--}}
{{--            <form action="{{ route('admin.logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit">Logout</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Main Content -->--}}
{{--    <div style="flex-grow: 1; padding: 20px;">--}}
{{--        <h1>Welcome back, Jadon Bator</h1>--}}
{{--        <div style="background-color: #2a2a2e; padding: 15px; border-radius: 8px; margin-bottom: 20px;">--}}
{{--            <h2 style="color: #b0ff1a;">EARN CASH</h2>--}}
{{--            <p>For Referrals!</p>--}}
{{--        </div>--}}
{{--        <!-- Add more content here -->--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skydiving</title>
</head>
<div id="loader-overlay">
    <div class="spinner"></div>
</div>
<body style="font-family: Arial, sans-serif; margin: 0; background-color: #1c1c1e; color: white;">

<div style="display: flex;">
    @include('admin.sidebar')

    <div style="flex-grow: 1; padding: 20px;">
        <h1>Welcome back, {{ ucfirst($admin->name ?? '') }}</h1>
        <div style="background-color: #2a2a2e; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #b0ff1a;">EARN CASH</h2>
            <p>For Referrals!</p>
        </div>
    </div>
</div>

</body>
</html>
