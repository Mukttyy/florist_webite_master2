<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background: #f5f6fa;
        }

        .sidebar {
            width: 220px;
            background: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            border-right: 1px solid #ddd;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
        }

        .sidebar a:hover {
            background: #eee;
        }

        .header {
            margin-left: 220px;
            background: #273469;
            color: white;
            padding: 15px;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')
    {{-- <div class="sidebar">
    <h2>GREATWEB</h2>
    <a href="dashboard">Dashboard</a>
    <a href="orders">Orders</a>
    <a href="products">Products</a>
    <a href="customers">Customers</a>
    <a href="discounts">Discounts</a>
    <a href="reports">Reports</a>
    <a href="settings">Settings</a>
  </div> --}}
    <div class="header">
        Orders List
    </div>
    <div class="content">
        <h3>All Orders</h3>
        <table>
            <tr>
                <th>Order#</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>#1001</td>
                <td>John Doe</td>
                <td>July 1, 2025</td>
                <td>Paid</td>
                <td>₱1,200</td>
            </tr>
        </table>
    </div>
</body>

</html>
