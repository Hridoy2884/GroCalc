<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Calculations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{-- Mobile responsiveness --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <h1 class="text-center mb-4">All Calculations</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>

                        <th>SL</th>
                        <th>Item</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($calculations as $index => $calculation)
                        <tr>
                            <td>{{ $index + 1 + ($calculations->currentPage() - 1) * $calculations->perPage() }}</td>
                            <td>{{ $calculation->item }}</td>
                            <td>{{ number_format($calculation->unitprice, 2) }}</td>
                            <td>{{ $calculation->quantity }}</td>
                            <td>{{ number_format($calculation->total, 2) }}</td>
                            <td>{{ $calculation->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach

                    <tr class="fw-bold bg-success text-white">
                        <td colspan="3" class="text-end">Grand Total:</td>
                        <td colspan="2">{{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- 👇 Add pagination here --}}

        {{ $calculations->links() }}

        <div class="row mt-4 gy-2">
            <div class="col-12 col-md-auto">
                <form action="{{ route('clearAll') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete ALL records?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Clear All Records</button>
                </form>
            </div>

            <div class="col-12 col-md-auto">
                <a href="{{ route('downloadPDF') }}" class="btn btn-success w-100">Download PDF</a>
            </div>

            <div class="col-12 col-md-auto">
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary w-100">Dashboard</a>
            </div>
        </div>
    </div>


</body>

</html>
