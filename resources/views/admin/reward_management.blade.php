{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>User Management</title>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            margin: 0;--}}
{{--            font-family: Arial, sans-serif;--}}
{{--            background-color: #1c1c1e;--}}
{{--            color: white;--}}
{{--        }--}}
{{--        .container {--}}
{{--            display: flex;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}
{{--        .sidebar {--}}
{{--            /* Sidebar styles here */--}}
{{--        }--}}
{{--        .main-content {--}}
{{--            flex-grow: 1;--}}
{{--            padding: 20px;--}}
{{--        }--}}
{{--        h2 {--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .filter-form {--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .filter-form input, .filter-form select, .filter-form button {--}}
{{--            padding: 8px;--}}
{{--            border-radius: 5px;--}}
{{--            border: none;--}}
{{--            margin-right: 10px;--}}
{{--        }--}}
{{--        .filter-form input {--}}
{{--            background-color: #2c2c2c;--}}
{{--            color: white;--}}
{{--        }--}}
{{--        .filter-form select {--}}
{{--            background-color: #2c2c2c;--}}
{{--            color: white;--}}
{{--        }--}}
{{--        .filter-form button {--}}
{{--            background-color: #00cc00;--}}
{{--            color: black;--}}
{{--            cursor: pointer;--}}
{{--        }--}}
{{--        table {--}}
{{--            width: 100%;--}}
{{--            background-color: #232323;--}}
{{--            border-collapse: collapse;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        th, td {--}}
{{--            padding: 10px;--}}
{{--            border-bottom: 1px solid #3a3a3a;--}}
{{--            text-align: left;--}}
{{--        }--}}

{{--        th {--}}
{{--            background-color: #00cc00;--}}
{{--            color: #3a3a3a;--}}
{{--        }--}}
{{--        tbody tr:nth-child(even) {--}}
{{--            background-color: #3a3a3a;--}}
{{--        }--}}
{{--        .action-link {--}}
{{--            color: #00cc00;--}}
{{--            text-decoration: none;--}}
{{--        }--}}
{{--        .pagination {--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .pagination button {--}}
{{--            padding: 6px 12px;--}}
{{--            margin: 0 5px;--}}
{{--            border: none;--}}
{{--            border-radius: 5px;--}}
{{--            background-color: #2c2c2c;--}}
{{--            color: white;--}}
{{--        }--}}
{{--        .pagination button.active {--}}
{{--            background-color: #b0ff1a;--}}
{{--            color: black;--}}
{{--        }--}}
{{--        .total-rewards {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="container">--}}
{{--    --}}{{-- Sidebar --}}
{{--    @include('admin.sidebar')--}}

{{--    --}}{{-- Main Content --}}
{{--    <div class="main-content">--}}
{{--        <h2>Reward Management</h2>--}}

{{--        <!-- Filter/Search -->--}}
{{--        <form method="GET" action="#" class="filter-form">--}}
{{--            <input type="text" name="search" placeholder="Search..." />--}}
{{--            <select name="status">--}}
{{--                <option value="">All Status</option>--}}
{{--                <option value="active">Active</option>--}}
{{--                <option value="inactive">Inactive</option>--}}
{{--            </select>--}}
{{--            <button type="submit">Filter</button>--}}
{{--        </form>--}}

{{--        <table>--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th><input type="checkbox"></th>--}}
{{--                <th>#</th>--}}
{{--                <th style="text-align-last: center">Name</th>--}}
{{--                <th style="text-align-last: center">Referral's</th>--}}
{{--                <th style="text-align-last: right">Action</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($refApproved as $index => $approved)--}}
{{--                <tr>--}}
{{--                    <td><input type="checkbox"></td>--}}
{{--                    <td>{{$index+1}}</td>--}}
{{--                    <td>--}}
{{--                        <div style="color: #00cc00;">{{ucfirst($approved->referredUser->name)??''}}</div>--}}
{{--                        <div style="color: white; font-size: 12px;">{{$approved->referredUser->phone_number??''}}</div>--}}
{{--                    </td>--}}
{{--                    <td  style="text-align: center; padding-right: 80px;">{{ucfirst($approved->user->name)??''}}</td>--}}
{{--                    <td style="text-align-last: right"><a href="#" style="color: #00cc00">Add Reward</a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}

{{--            </tbody>--}}
{{--        </table>--}}


{{--    </div>--}}
{{--</div>--}}

{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1c1c1e;
            color: white;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            /* Sidebar styles here */
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input, .filter-form select, .filter-form button {
            padding: 8px;
            border-radius: 5px;
            border: none;
            margin-right: 10px;
        }
        .filter-form input {
            background-color: #2c2c2c;
            color: white;
        }
        .filter-form select {
            background-color: #2c2c2c;
            color: white;
        }
        .filter-form button {
            background-color: #00cc00;
            color: black;
            cursor: pointer;
        }
        table {
            width: 100%;
            background-color: #232323;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #3a3a3a;
            text-align: center;
        }
        th:first-child, td:first-child {
            text-align: left;
        }
        th:last-child, td:last-child {
            text-align: right;
        }
        th {
            background-color: #00cc00;
            color: #3a3a3a;
        }
        tbody tr:nth-child(even) {
            background-color: #3a3a3a;
        }
        .action-link {
            color: #00cc00;
            text-decoration: none;
        }
        .pagination {
            text-align: center;
        }
        .pagination button {
            padding: 6px 12px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: white;
        }
        .pagination button.active {
            background-color: #b0ff1a;
            color: black;
        }
        .total-rewards {
            display: flex;
            justify-content: space-between;
        }

        /* Modal Styles */
        #rewardModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #rewardModal .modal-content {
            background-color: #1c1c1e;
            padding: 30px;
            border-radius: 12px;
            width: 500px; /* thoda bara kar diya */
            color: white;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }
        #rewardModal input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: white;
            border: none;
            margin-top: 8px;
        }
        #rewardModal label {
            margin-top: 15px;
            display: block;
        }
        #rewardModal button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        #rewardModal .btn-cancel {
            background-color: #3a3a3a;
            color: white;
            margin-right: 10px;
        }
        #rewardModal .btn-submit {
            background-color: #00cc00;
            color: black;
        }
        #rewardModal .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 24px;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }

        #refRecordModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #refRecordModal .modal-content {
            background-color: #1c1c1e;
            padding: 30px;
            border-radius: 12px;
            width: 500px;
            color: white;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        #refRecordModal h3 {
            margin-top: 0;
            color: #00cc00;
        }

        #refRecordModal .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 24px;
            color: white;
        }

        #refRecordModal .reward-entry {
            margin-bottom: 15px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        #refRecordModal .reward-entry div {
            margin: 5px 0;
        }

        #refRecordModal button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            background-color: #3a3a3a;
            color: white;
        }
        .input-error {
            border: 1px solid red !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }
        #updateRewardModal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #updateRewardModal .modal-content {
            background-color: #1a1a1a;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            color: white;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.3);
        }

    </style>
</head>
<body>

<div class="container">
    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <div class="main-content">
        <h2>Reward Management</h2>

        <!-- Filter/Search -->
        <form method="GET" action="#" class="filter-form">
            <input type="text" name="search" placeholder="Search..." />
            <select name="status">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <button type="submit">Filter</button>
        </form>

        <table>
            <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>#</th>
                <th>Name</th>
                <th>Referral's</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($refApproved as $index => $approved)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>{{$index+1}}</td>
                    <td>
                        <div style="color: #00cc00;">{{ucfirst($approved->referredUser->name)??''}}</div>
                        <div style="color: white; font-size: 12px;">{{$approved->referredUser->phone_number??''}}</div>
                    </td>
                    <td>{{ucfirst($approved->user->name)??''}}</td>
                    <td>
                        @if(in_array($approved->referredUser->id, $rewardedIds))
                            <span style="color: gray;">Already Rewarded</span><br>
{{--                            <a href="javascript:void(0);" style="color: gray;">Ref Record</a>--}}
                            <a href="javascript:void(0);" onclick="openRefRecordModal({{ $approved->referredUser->id }})" style="color: #00cc00;">Ref Record</a>
                        @else
                            <a href="javascript:void(0);" onclick="openRewardModal('{{ $approved->referredUser->id }}')" style="color: #00cc00">Add Reward</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

<div id="refRecordModal" onclick="outsideClick(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="close-btn" onclick="closeRefRecordModal()">&times;</div>
        <h3 style="margin-top: 0; color: #00cc00;">Referral Reward History</h3>

        <!-- USER NAME GOES HERE -->
        <div id="refUserName" style="margin-bottom: 15px; font-weight: bold; color: white;"></div>

        <!-- Reward entries -->
        <div id="refRewardList"></div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="button" onclick="closeRefRecordModal()" class="btn-cancel">Close</button>
        </div>
    </div>
</div>


<!-- Reward Modal -->
<!-- Reward Modal -->
<div id="rewardModal" onclick="outsideClick(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="close-btn" onclick="closeRewardModal()">&times;</div>
        <h3 style="margin-top: 0; color: #00cc00;">Generate Coupon</h3>
        <form action="{{ route('admin.assign_reward') }}" id="rewardValidate" method="POST">

            @csrf

            <!-- Hidden User ID -->
            <input type="hidden" id="rewardUserId" name="user_id">

            <label>Points</label>
            <input type="number" name="points" id="points" placeholder="Enter Points" min="0" required onkeydown="blockInvalidChars(event)">

            <label>Discount %</label>
            <input type="number" name="discount" id="discount" placeholder="Enter Discount %" min="0" max="100" required onkeydown="blockInvalidChars(event)">

            <div style="text-align: right; margin-top: 20px;">
                <button type="button" onclick="closeRewardModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">Generate Coupon</button>
            </div>
        </form>
    </div>
</div>


<!-- Reward Modal -->
{{--<div id="updateRewardModal" onclick="outsideClick(event)">--}}
{{--    <div class="modal-content" onclick="event.stopPropagation()">--}}
{{--        <div class="close-btn" onclick="closeUpdateRewardModal()">&times;</div>--}}
{{--        <h3 style="margin-top: 0; color: #00cc00;">Update Reward</h3>--}}

{{--        <form action="{{ route('admin.update_reward') }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <input type="hidden" name="id" id="editRewardId">--}}

{{--            <label>Points</label>--}}
{{--            <input type="number" name="points" id="editPoints" min="0" required>--}}

{{--            <label>Discount %</label>--}}
{{--            <input type="number" name="discount" id="editDiscount" min="0" max="100" required>--}}

{{--            <div style="text-align: right; margin-top: 20px;">--}}
{{--                <button type="button" onclick="closeUpdateRewardModal()" class="btn-cancel">Cancel</button>--}}
{{--                <button type="submit" class="btn-submit">Update</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}


<!-- Scripts -->
<script>
    function openRewardModal(userId) {
        document.getElementById('rewardUserId').value = userId;
        document.getElementById('rewardModal').style.display = 'flex';
    }

    function closeRewardModal() {
        document.getElementById('rewardModal').style.display = 'none';
    }

    function outsideClick(event) {
        if (event.target.id === 'rewardModal') {
            closeRewardModal();
        }
    }

    function validateForm() {
        var points = document.getElementById('points').value;
        var discount = document.getElementById('discount').value;

        if (points < 0 || discount < 0) {
            alert("Negative values not allowed.");
            return false;
        }
        if (points.includes('-') || discount.includes('-') || points.includes('+') || discount.includes('+')) {
            alert("Only positive numbers allowed.");
            return false;
        }
        return true;
    }
</script>


<script>
    const allRewards = @json($rewardsData); // Make sure $rewardsData is passed from controller

    function openRefRecordModal(userId) {
        const container = document.getElementById('refRewardList');
        const nameDisplay = document.getElementById('refUserName');

        container.innerHTML = '';
        nameDisplay.innerHTML = '';

        const rewards = allRewards[userId];

        if (!rewards || rewards.length === 0) {
            nameDisplay.innerHTML = `<strong>Name:</strong> User ID: ${userId}`;
            container.innerHTML = '<p>No rewards found for this user.</p>';
        } else {
            // Show name from first reward record
            const userName = rewards[0].user?.name || 'Unknown User';
            nameDisplay.innerHTML = `<strong>Name:</strong> ${userName}`;

            rewards.forEach(reward => {
                const item = document.createElement('div');
                item.classList.add('reward-entry');
            //     item.innerHTML = `
            //     <div><strong>Points:</strong> ${reward.points}</div>
            //     <div><strong>Discount:</strong> ${reward.discount}%</div>
            //     <div><strong>Coupon Code:</strong> ${reward.coupon_code || '-'}</div>
            //     <div><strong>Coupon Value:</strong> ${reward.coupon_value || '-'}</div>
            //     <div><strong>Date:</strong> ${new Date(reward.created_at).toLocaleDateString()}</div>
            // `;
                item.innerHTML = `
    <div><strong>Points:</strong> ${reward.points}</div>
    <div><strong>Discount:</strong> ${reward.discount}%</div>
    <div><strong>Coupon Code:</strong> ${reward.coupon_code || '-'}</div>
    <div><strong>Coupon Value:</strong> ${reward.coupon_value || '-'}</div>
    <div><strong>Date:</strong> ${new Date(reward.created_at).toLocaleDateString()}</div>

`;
                // <div style="margin-top: 5px;">
                //     <button onclick="openUpdateRewardModal(${reward.id}, ${reward.points}, ${reward.discount})">Edit</button>
                // </div>
                container.appendChild(item);
            });
        }

        document.getElementById('refRecordModal').style.display = 'flex';
    }

    function closeRefRecordModal() {
        document.getElementById('refRecordModal').style.display = 'none';
    }

    function outsideClickRef(event) {
        if (event.target.id === 'refRecordModal') {
            closeRefRecordModal();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#rewardValidate').validate({
            rules: {
                discount: {
                    required: true,
                    min: 0,
                    max: 100
                },
                points: {
                    required: true,
                    min: 0
                }
            },
            messages: {
                discount: {
                    required: "Please enter Discount.",
                    min: "Discount cannot be negative.",
                    max: "Discount cannot be more than 100%."
                },
                points: {
                    required: "Please enter Points.",
                    min: "Points cannot be negative."
                }
            },
            highlight: function (element) {
                $(element).addClass('input-error');
            },
            unhighlight: function (element) {
                $(element).removeClass('input-error');
            },
            errorPlacement: function () {
                return false; // hide error messages
            },
            submitHandler: function (form) {
                // Final custom validation before submission
                const points = $('#points').val();
                const discount = $('#discount').val();

                if (points.includes('-') || points.includes('+') || discount.includes('-') || discount.includes('+')) {
                    alert("Only positive numeric values allowed.");
                    return false;
                }

                form.submit();
            }
        });
    });
</script>

<script>
    function blockInvalidChars(e) {
        if (["e", "E", "+", "-"].includes(e.key)) {
            e.preventDefault();
        }
    }
</script>
{{--<script>--}}
{{--    function openUpdateRewardModal(id, points, discount) {--}}
{{--        document.getElementById('editRewardId').value = id;--}}
{{--        document.getElementById('editPoints').value = points;--}}
{{--        document.getElementById('editDiscount').value = discount;--}}
{{--        document.getElementById('updateRewardModal').style.display = 'flex';--}}
{{--    }--}}

{{--    function closeUpdateRewardModal() {--}}
{{--        document.getElementById('updateRewardModal').style.display = 'none';--}}
{{--    }--}}
{{--</script>--}}


</body>
</html>
