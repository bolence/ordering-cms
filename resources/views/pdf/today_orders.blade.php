<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Porudžbenice na dan {{ today()->format('d.m.Y') }}</title>

    <style>
        tr {
            page-break-inside: avoid;
        }

        @media print {
            footer {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>

    <div class="row">

        <div class="col-md-12">
            <h2
                style="text-align: center; margin: 0 auto; padding: 30px; font-weight: bolder; font-style: 'Helvetica'; ">
                Sve porudžbenice na dan {{ today()->format('d.m.Y') }}. - ukupno {{ $orders->count() }} porudžbenica
                (suma:
                {{ number_format($orders->sum('price'), 2) }})
            </h2>
            <table class="table table-bordered table-striped" border="1">
                <thead bgcolor="#48c2ea">
                    <th>Poručio</th>
                    <th>Broj porudžbine</th>
                    <th>Tip dostave</th>
                    <th>Status</th>
                    <th>Poručeno sa</th>
                    <th>Broj proizvoda</th>
                    <th>Suma</th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->customer?->name }}</td>
                            <td>{{ $order?->order_number }}</td>
                            <td>{{ $order?->delivery_type }}</td>
                            <td>{{ $order?->status?->status }}</td>
                            <td>{{ $order?->order_from }}</td>
                            <td>{{ $order?->order_items_count ?? 0 }}</td>
                            <td>{{ number_format($order->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
