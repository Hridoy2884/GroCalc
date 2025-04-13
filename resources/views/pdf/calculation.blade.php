<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cost for this Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Your Cost for these Products</h1>

<table>
    <thead>
        <tr>
            <th>Sl</th>
            <th>Item</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calculations as $index => $calculation)
        <tr>
            <td>{{ ($calculations->currentPage() - 1) * $calculations->perPage() + $loop->iteration }}</td>
            <td>{{ $calculation->item }}</td>
            <td>{{ number_format($calculation->unitprice, 2) }}</td>
            <td>{{ $calculation->quantity }}</td>
            <td>{{ number_format($calculation->total, 2) }}</td>
            <td>{{ $calculation->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="3" style="text-align:right;"><strong>Grand Total:</strong></td>
            <td colspan="2"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
        </tr>
    </tbody>
</table>

</body>
</html>
