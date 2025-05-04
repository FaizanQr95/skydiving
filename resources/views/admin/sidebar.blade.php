{{--<div style="width: 250px; background-color: #232323; padding: 20px;">--}}
{{--    <h2 style="color: #e0e0e0;">Skydiving</h2>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--        <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="{{url('admin/dashboard')}}" style="text-decoration: none; color: #b0ff1a;">Dashboard</a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <br>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--        <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="#" style="text-decoration: none; color: #b0ff1a;">Referal Management</a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--        <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="{{url('admin/user-management')}}" style="text-decoration: none; color: #b0ff1a;">User Management</a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--            <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="#" style="text-decoration: none; color: #b0ff1a;">Rewards Management</a>--}}
{{--            </div>--}}
{{--        </ul>--}}

{{--    <br>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--                <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="#" style="text-decoration: none; color: #b0ff1a;">Settings</a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--        <div style="background-color: #2c2c2c; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="#" style="text-decoration: none; color: #b0ff1a;">Notifications</a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <ul style="list-style-type: none; padding: 0;">--}}
{{--        <div style="background-color: #2c2c2c; margin-top: 70px; padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a;">--}}
{{--            <a href="{{ url('profile') }}" style="text-decoration: none; color: #b0ff1a; font-weight: bold;">Profile--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </ul>--}}

{{--    <div style="margin-top: 70px;">--}}
{{--        <form action="{{ route('admin.logout') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <button type="submit" style="background-color: lime; color: white; padding: 10px; width: 100px; display: inline-block; border-radius: 4px;">Logout</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

<style>
    @keyframes parachute-float {
        0% {
            transform: translateY(-100px) rotate(-10deg);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 1;
        }
    }

    .parachute-animate {
        animation: parachute-float 1.5s ease-out;
    }
</style>

<div style="width: 250px; background-color: #232323; padding: 20px; display: flex; flex-direction: column; height: 100vh; justify-content: space-between;">
    <div>
{{--        <div style="text-align-last: center">--}}
{{--            <a href="{{url('admin/dashboard')}}">--}}
{{--                <img src="{{ asset('images/icons/skydiving.png') }}" alt="Skydiving Icon" style="width: 150px; height: 120px; margin-right: 15px;">--}}

{{--            </a>--}}
{{--        </div>--}}
        <div style="text-align-last: center">
            <a href="{{ url('admin/dashboard') }}">
                <img id="parachute-image" src="{{ asset('images/icons/skydiving.png') }}" alt="Skydiving Icon"
                     style="width: 200px; height: 150px; margin-right: 15px;">
            </a>
        </div>

        {{--        <h2 style="color: #e0e0e0; margin-bottom: 20px;">Skydiving</h2>--}}

        <ul style="list-style-type: none; padding: 0;">

            <li style="margin-bottom: 10px;">
                <a href="{{ url('admin/dashboard') }}"
                   style="display: block; background-color: {{ Request::is('admin/dashboard') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/dashboard') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    ⭐ Dashboard
                </a>
            </li>

            <br>
            <li style="margin-bottom: 10px;">
                <a href="{{ url('admin/user-management') }}"
                   style="display: block; background-color: {{ Request::is('admin/user-management') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/user-management') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    👤 User Management
                </a>
            </li>

            <li style="margin-bottom: 10px;">
                <a href="{{ url('admin/referral-management') }}"
                   style="display: block; background-color: {{ Request::is('admin/referral-management') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/referral-management') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    🤝  Referral Management
                </a>
            </li>

            <li style="margin-bottom: 10px;">
                <a href="{{url('admin/reward-management')}}"
                   style="display: block; background-color: {{ Request::is('admin/reward-management') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/reward-management') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    🎁 Rewards Management
                </a>
            </li>

            <li style="margin-bottom: 10px;">
                <a href="{{ url('admin/customer') }}"
                   style="display: block; background-color: {{ Request::is('admin/customer') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/customer') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    🧑‍🤝‍🧑 Customers
                </a>
            </li>



            <br>

{{--            <li style="margin-bottom: 10px;">--}}
{{--                <a href="{{ url('admin/profile') }}"--}}
{{--                   style="display: block; background-color: {{ Request::is('admin/profile') ? '#00cc00' : '#2c2c2c' }};--}}
{{--                   color: {{ Request::is('admin/profile') ? '#000' : '#00cc00' }};--}}
{{--                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">--}}
{{--                    ⚙️ Settings--}}
{{--                </a>--}}
{{--            </li>--}}

            <li style="margin-bottom: 10px;">
                <a href="#"
                   style="display: block; background-color: {{ Request::is('admin/notifications') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/notifications') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    🔔 Notifications
                </a>
            </li>

            <li style="margin-bottom: 10px;">
                <a href="#"
                   style="display: block; background-color: {{ Request::is('admin/support-chat') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/support-chat') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    🔔 Notifications
                </a>
            </li>

            <li style="margin-top: 60px;">
                <a href="{{url('admin/profile')}}"
                   style="display: block; background-color: {{ Request::is('admin/profile') ? '#00cc00' : '#2c2c2c' }};
                   color: {{ Request::is('admin/profile') ? '#000' : '#00cc00' }};
                   padding: 10px 15px; border-radius: 8px; border: 1px solid #3a3a3a; text-decoration: none;">
                    👤 Profile
                </a>
            </li>

        </ul>
        <br>
        <div style="text-align: center;">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        style="background-color: #00cc00; color: black; padding: 10px 20px; width: 100%; border: none;
                    border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                    Logout
                </button>
            </form>
        </div>
    </div>


</div>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const img = document.getElementById('parachute-image');
        img.classList.add('parachute-animate');

        setTimeout(() => {
            img.classList.remove('parachute-animate');
        }, 2000);
    });
</script>
