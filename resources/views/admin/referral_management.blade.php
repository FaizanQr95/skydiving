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
            text-align: left;
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
    </style>
</head>
<body>

<div class="container">
    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <div class="main-content">
        <h2>Referral Management</h2>

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
                <th style=" text-align: center; padding-right: 80px;">Referred Name</th>
                <th style=" text-align: center; padding-right: 80px;">Status</th>
                <th style="text-align: right; padding-right: 80px;">Referral Date</th>
                <th style="text-align: right; padding-right: 80px;">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userRef as $index => $referral)
            <tr>
                    <td><input type="checkbox"></td>
                    <td>{{$index+1}}</td>
                    <td>
                        <div style="color: #00cc00;">{{ucfirst($referral->user->name)??''}}</div>
                        <div style="color: white; font-size: 12px;">{{$referral->user->phone_number??''}}</div>
                    </td>
                    <td  style="text-align: center; padding-right: 80px;">{{ucfirst($referral->referredUser->name)??''}}</td>
                <td class="status-cell" style="text-align: center; padding-right: 80px;">

                    @if($referral->status == 'pending')
                        <span style="background-color: #E0F7E9; color: #000; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                                🟡 Pending
                        </span>
                    @elseif($referral->status == 'approved')
                        <span style="background-color: #E0F7E9; color: #008000; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                                ✅ Approved
                        </span>
                    @elseif($referral->status == 'rejected')
                        <span style="background-color: #FDEAEA; color: #FF0000; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                                ❌ Rejected
                        </span>
                    @else
                        <span>-</span>
                    @endif

                </td>
                    <td style="text-align: right; padding-right: 80px;">{{$referral->created_at->format('d-M-Y')??''}}</td>
                <td style="text-align: right; padding-right: 50px;">
                    @if($referral->status == 'pending')
                    <button class="change-status-btn" data-id="{{ $referral->id }}" data-status="approved" style="background-color: #00cc00; color: white; padding: 5px 15px; border: none; width: 100px; border-radius: 20px; margin-bottom: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#009900';" onmouseout="this.style.backgroundColor='#00cc00';">
                        Approve
                    </button>
                    <br>
                    <button class="change-status-btn" data-id="{{ $referral->id }}" data-status="rejected" style="background-color: #FF0000; color: white; padding: 5px 15px; border: none; width: 100px; border-radius: 20px; margin-top: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#cc0000';" onmouseout="this.style.backgroundColor='#FF0000';">
                        Reject
                    </button>
                    @elseif($referral->status == 'approved')
                        <button class="change-status-btn" data-id="{{ $referral->id }}" data-status="rejected" style="background-color: #FF0000; color: white; padding: 5px 15px; border: none; width: 100px; border-radius: 20px; margin-top: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#cc0000';" onmouseout="this.style.backgroundColor='#FF0000';">
                            Reject
                        </button>
                    @elseif($referral->status == 'rejected')
                        <button class="change-status-btn" data-id="{{ $referral->id }}" data-status="approved" style="background-color: #00cc00; color: white; padding: 5px 15px; border: none; width: 100px; border-radius: 20px; margin-bottom: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#009900';" onmouseout="this.style.backgroundColor='#00cc00';">
                            Approve
                        </button>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        $('.change-status-btn').click(function() {
            var button = $(this);
            var newStatus = button.data('status'); // approved or rejected
            var referralId = button.data('id');    // referral id

            // Show confirmation prompt
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update the status to " + newStatus + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00cc00',
                cancelButtonColor: '#d33',
                background: '#000',
                color: '#fff',
                iconColor: '#ff0000',
                // confirmButtonColor: '#ff0000',
                confirmButtonText: 'Yes, update!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with the AJAX request
                    $.ajax({
                        url: 'info/public/admin/update-referral-status',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: referralId,
                            status: newStatus
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Status updated successfully.',
                                    icon: 'success',
                                    background: '#000',
                                    color: '#fff',
                                    iconColor: '#00cc00',
                                    confirmButtonColor: '#00cc00'
                                }).then(() => {
                                    // Refresh the page after successful status update
                                    location.reload();
                                });

                                var statusCell = button.closest('tr').find('.status-cell');
                                if (newStatus === 'approved') {
                                    statusCell.html('<span style="background-color: #E0F7E9; color: #388E3C; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">✅  Approved</span>');
                                } else if (newStatus === 'rejected') {
                                    statusCell.html('<span style="background-color: #FDEAEA; color: #D32F2F; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">❌ Rejected</span>');
                                }
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to update status.',
                                    icon: 'error',
                                    background: '#000',
                                    color: '#fff',
                                    iconColor: '#ff0000',
                                    confirmButtonColor: '#ff0000'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong.',
                                icon: 'error',
                                background: '#000',
                                color: '#fff',
                                iconColor: '#ff0000',
                                confirmButtonColor: '#ff0000'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
