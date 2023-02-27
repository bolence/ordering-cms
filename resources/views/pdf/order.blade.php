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
                Detalji porudžbenice {{ $order->order_number }} @if ($order->price)
                    - suma: {{ number_format($order->price, 2) }}
                @endif
            </h2>
            <table class="table table-bordered table-striped" border="1">
                <tbody>
                    <tr>
                        <td class="fw-bold w-25">Broj porudžbenice</td>
                        <td>{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Način dostave</td>
                        <td>{{ $order->delivery_type }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Datum poručivanja</td>
                        <td>{{ $order->order_date }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Datum isporuke</td>
                        <td>{{ $order->delivery_date }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Napomena</td>
                        <td>{{ $order->napomena }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Poručeno sa</td>
                        <td>{{ $order->order_from }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold w-25">Status</td>
                        <td>{{ $order->status->status }}</td>
                    </tr>

                    <tr>
                        <td class="fw-bold w-25">Poručio</td>
                        <td>{{ $order->customer->name }}</td>
                    </tr>

                    <tr>
                        <td class="fw-bold w-25">Broj telefona</td>
                        <td>{{ $order->customer->phone }}</td>
                    </tr>

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
                </tbody>
            </table>
        </div>




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


        {{-- 
        @if ($buy_bills->count())
            <div class="col-md-12">
                <h3
                    style="text-align: center; margin: 0 auto; padding: 30px; font-weight: bolder; font-style: 'Helvetica'; ">
                    Moji računi nabavke {{ $date }} - suma: {{ $sum_bills_buys }} RSD.
                    ({{ $buy_bills->count() }})</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr bgcolor="#fdb817">
                            <th scope="col">Nabavka</th>
                            <th scope="col">Šifra</th>
                            <th scope="col">Iznos</th>
                            <th scope="col">Datum računa</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($buy_bills->get() as $buy_bill)
                            <tr>
                                <th style="width: 700px;">{{ $buy_bill->buy->offer }}</th>
                                <td>{{ $buy_bill->buy->code }}</td>
                                <td>{{ number_format($buy_bill->vrednost, 2) }}</td>
                                <td>{{ date('d.m.Y H:m', strtotime($buy_bill->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($buy_reservations->count())
            <div class="col-md-12">
                <h3
                    style="text-align: center; margin: 0 auto; padding: 30px; font-weight: bolder; font-style: 'Helvetica'; ">
                    Moje rezervacije nabavke {{ $date }} - suma: {{ $sum_reservations_buys }} RSD.
                    ({{ $buy_reservations->count() }})</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr bgcolor="#fdb817">
                            <th scope="col">Nabavka</th>
                            <th scope="col">Šifra nabavke</th>
                            <th scope="col">Rezervacija</th>
                            <th scope="col">Datum rezervacije</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($buy_reservations->get() as $buy_reservation)
                            <tr>
                                <th style="width: 900px;">{{ $buy_reservation->buy->offer }}</th>
                                <td>{{ $buy_reservation->buy->code }}</td>
                                <td>{{ number_format($buy_reservation->reserved, 2) }}</td>
                                <td>{{ date('d.m.Y H:m', strtotime($buy_reservation->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif --}}

    </div>

</body>

</html>
