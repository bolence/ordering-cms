<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Porudžbenica {{ $order->order_number }}</title>

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

        <div class="col-md-10">
            <h2
                style="text-align: center; margin: 0 auto; padding: 30px; font-weight: bolder; font-style: 'Helvetica'; ">
                Detalji porudžbenice <span class="fw-bolder">"{{ $order->order_number }}"</span>
                @if ($order->price)
                    - suma: {{ number_format($order->price, 2) }}
                @endif
            </h2>
            <table class="table table-bordered table-striped" border="1">
                <tbody>
                    <tr>
                        <td class="fw-bold w-25">Poručio</td>
                        <td>{{ $order?->customer?->name }}

                        </td>
                    </tr>
                    @if ($order?->customer->firma)
                        <tr>
                            <td class="fw-bold w-25">Firma</td>
                            <td>{{ $order->customer->firma }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="fw-bold w-25">Datum poručivanja</td>
                        <td>{{ $order?->order_date }}</td>
                    </tr>

                    <tr>
                        <td class="fw-bold w-25">Datum isporuke</td>
                        <td>{{ $order?->delivery_date }}</td>
                    </tr>

                    <tr>
                        <td class="fw-bold w-25">Napomena</td>
                        <td>{{ $order?->napomena }}</td>
                    </tr>

                    @if ($order->payment_type)
                        <tr>
                            <td class="fw-bold w-25">Način plaćanja</td>
                            <td>{{ $order->payment_type }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="fw-bold w-25">Način dostave</td>
                        <td>{{ $order?->delivery_type }}</td>
                    </tr>

                    <tr>
                        <td class="fw-bold w-25">Poručeno sa</td>
                        <td>{{ $order?->order_from }}</td>
                    </tr>


                    @if ($order->price)
                        <tr>
                            <td class="fw-bold w-25">Suma</td>
                            <td>{{ number_format($order->price, 2) }} RSD.</td>
                        </tr>
                    @endif

                    @if ($order->customer->phone)
                        <tr>
                            <td class="fw-bold w-25">Broj telefona</td>
                            <td>{{ $order->customer->phone }}</td>
                        </tr>
                    @endif

                    @if ($order->customer->street)
                        <tr>
                            <td class="fw-bold w-25">Adresa</td>
                            <td>{{ $order->customer->street }}</td>
                        </tr>
                    @endif

                    @if ($order->customer->city)
                        <tr>
                            <td class="fw-bold w-25">Grad</td>
                            <td>{{ $order->customer->city }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="fw-bold w-25">Status</td>
                        <td>{{ $order?->status->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($order->order_items->count() > 0)
            <div class="col-md-10">
                <h2
                    style="text-align: center; margin: 0 auto; padding: 30px; font-weight: bolder; font-style: 'Helvetica'; ">
                    Proizvodi u porudžbini - {{ $order->order_items->count() }}</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr bgcolor="#48c2ea">
                            <th>Tip proizvoda</th>
                            <th>Veličina bedža/majice</th>
                            <th>
                                Tip kačenja/ Boja majice
                            </th>
                            <th>
                                Plastifikacija/Tip majice
                            </th>
                            <th>Količina</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($order->order_items as $item)
                            <tr>
                                <th>{{ ucfirst($item->type) }}</th>
                                <th>{{ $item->badge_size ?? $item->tshirt_size }}</th>
                                <td>{{ $item->tip_kacenja ?? $item->tshirt_color }}</td>
                                <td>{{ ucfirst($item->plastifikacija ?? $item->tshirt_type) }}</td>
                                <td>{{ $item->quantity }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>

</html>
