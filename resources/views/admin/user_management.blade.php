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
            color: #b0ff1a;
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
        .status-badge {
            padding: 4px 10px;
            border-radius: 999px; /* fully rounded */
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            color: white;
        }

        .status-badge.active {
            background-color: #00cc00;
        }

        .status-badge.blocked {
            background-color: #ff4444;
        }

        .custom-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #00cc00;
            padding: 12px 20px;
            border-radius: 6px;
            color: white;
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin-top: 20px;
        }

        .custom-pagination .result-info {
            flex: 1;
            text-align: left;
        }

        .custom-pagination .page-info {
            flex: 1;
            text-align: center;
        }

        .custom-pagination .pagination-arrows {
            flex: 1;
            text-align: right;
        }

        .custom-pagination .arrow {
            background: white;
            color: #00cc00;
            padding: 6px 12px;
            margin-left: 5px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .custom-pagination .arrow:hover {
            background: #ddd;
        }

        .custom-pagination .arrow.disabled {
            background: #ccc;
            color: #666;
            pointer-events: none;
        }

        /* Arrows (Previous and Next) */
        /* Hide previous and next arrows */
        /* Hide previous and next arrows */
        nav[role="navigation"] svg {
            display: none !important;
        }

    </style>
</head>
<body>

<div class="container">
    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <div class="main-content">
        <h2>User Management</h2>

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
                <th>Email</th>
                <th>Status</th>
                <th>Total Rewards Earned</th>
                <th>Total Referrals</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $client)
                <tr>
                    <td><input type="checkbox"></td>

                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>

                    <td>
                        <div style="color: #00cc00;">{{ ucfirst($client->name) ?? '' }}</div>
                        <div style="color: white; font-size: 12px;">{{ $client->phone_number ?? '' }}</div>
                    </td>

                    <td>{{ $client->email ?? '' }}</td>

                    <td>
                        @if ($client->status === 'active')
                            <span style="background-color: #E0F7E9; color: #008000; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                               Active
                        </span>
                        @else
                            <span style="background-color: #FDEAEA; color: #FF0000; padding: 4px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                                Blocked
                        </span>
                        @endif
                    </td>

                    <td>${{ $client->ref_price ?? '0' }}</td>
{{--                    <td>{{ $client->invited_ref_ids ?? '0' }}</td>--}}
                    @php
                        $referrals = json_decode(str_replace("'", '"', $client->invited_ref_ids), true);
                    @endphp
                    <td>{{ is_array($referrals) ? count($referrals) : 0 }}</td>

                    <td><a href="#" class="action-link">View Profile</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="custom-pagination">
            {{-- Left: Showing info --}}
            <div class="result-info">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>

            {{-- Center: Page 1 / Total --}}
            <div class="page-info">
                Page {{ $users->currentPage() }} / {{ $users->lastPage() }}
            </div>

            {{-- Right: Arrows --}}
            <div class="pagination-arrows">
                @if ($users->onFirstPage())
                    <span class="arrow disabled">←</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="arrow">←</a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="arrow">→</a>
                @else
                    <span class="arrow disabled">→</span>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
