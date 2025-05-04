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


        /* Pagination Container */
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
        <h2>Customer</h2>

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
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $index => $customer)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>{{ ($customers->firstItem() ?? 0) + $index }}</td>
                    <td>
                        <div style="color: #00cc00;">{{ $customer['given_name'] ?? '' }} {{ $customer['family_name'] ?? '' }}</div>
                        <div style="color: white; font-size: 12px;">{{ $customer['phone_number'] ?? 'No phone number' }}</div>
                    </td>
                    <td>{{ $customer['email_address'] ?? 'No email' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        <div style="margin-top: 20px;">--}}
{{--            {{ $customers->links() }}--}}
{{--        </div>--}}
        <div class="custom-pagination">
            {{-- Left: Showing info --}}
            <div class="result-info">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} results
            </div>

            {{-- Center: Page 1 / Total --}}
            <div class="page-info">
                Page {{ $customers->currentPage() }} / {{ $customers->lastPage() }}
            </div>

            {{-- Right: Arrows --}}
            <div class="pagination-arrows">
                @if ($customers->onFirstPage())
                    <span class="arrow disabled">←</span>
                @else
                    <a href="{{ $customers->previousPageUrl() }}" class="arrow">←</a>
                @endif

                @if ($customers->hasMorePages())
                    <a href="{{ $customers->nextPageUrl() }}" class="arrow">→</a>
                @else
                    <span class="arrow disabled">→</span>
                @endif
            </div>
        </div>


    </div>
</div>

</body>
</html>
