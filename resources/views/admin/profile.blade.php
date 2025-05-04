
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1e1e1e;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }
        .sidebar {
            width: 250px;
            background-color: #111;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            background-color: #2a2a2a;
        }
        .sidebar a.active {
            background-color: #00cc00;
            color: black;
            font-weight: bold;
        }

        .content {
            flex-grow: 1;
            background: #1c1c1e;
            padding: 40px;
            overflow-y: auto;
        }

        .form-box {
            width: 100%;
            max-width: 700px;
            margin: auto;
            background: #1c1c1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00cc00;
        }

        .profile-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .profile-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #00cc00;
            margin-bottom: 10px;
        }

        .upload-btn {
            background-color: #222;
            border: 1px solid #00cc00;
            color: #00cc00;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .upload-btn:hover {
            background-color: #00cc00;
            color: #fff;
        }

        input[type="file"] {
            display: none;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #fff;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #444;
            border-radius: 6px;
            background: #1c1c1c;
            color: white;
        }

        input::placeholder {
            color: #aaa;
        }

        button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #00b300;
        }
    </style>
</head>
<body>
<div class="container">
    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <div class="content">
        <div class="form-box">
            <h2>Profile</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Image --}}
                <div class="profile-image">
                    <img id="previewImage"
                         src="{{ $admin->image ? 'https://deinfini.com/info/storage/app/public/' . $admin->image : asset('admin_images/admin-avatar.png') }}"
                         alt="Profile Image">
                    <label class="upload-btn">
                        {{ $admin->image ? 'Change' : 'Upload' }}
                        <input type="file" id="profile_image" name="image" accept="image/*" onchange="previewFile()">
                    </label>
                </div>

                {{-- Fields --}}
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name ?? '') }}" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required>

                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        background: '#000',
        color: '#fff',
        iconColor: '#00cc00',
        confirmButtonColor: '#00cc00'
    });
    @endif
</script>

{{-- Image Preview --}}
<script>
    function previewFile() {
        const input = document.getElementById('profile_image');
        const preview = document.getElementById('previewImage');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
