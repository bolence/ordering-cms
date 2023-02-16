@extends('layouts.app')
@push('css')
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush



@section('content')
    <div class="page-content">

        <div class="col-xl-12 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-4">
                                <i class="bx bxs-user me-1 font-22 text-primary"></i>
                                Spisak poručenih bedževa - {{ $orders->count() }}
                            </h5>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tshirt">
                            <thead class="table-light">
                                <tr>
                                    <th>Broj porudžbine</th>
                                    <th>Veličina majice</th>
                                    <th>Boja majice</th>
                                    <th>Tip majice</th>
                                    <th>Poručio</th>
                                    <th>Količina</th>
                                    <th>Suma</th>
                                    <th>Poručeno</th>
                                    <th>Detalji</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order->order_number }}</td>
                                        <td>{{ strtoupper($order->tshirt_size) }}</td>
                                        <td>{{ ucfirst($order->tshirt_color) }}</td>
                                        <td>{{ ucfirst($order->tshirt_type) }}</td>
                                        <td>{{ $order->order->customer->name }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ number_format($order->order->price, 2) }}</td>
                                        <td>{{ $order->order->order_date->format('d.m.Y') }}</td>

                                        <td>
                                            <a href="/order/{{ $order->order->id }}"
                                                class="btn btn-primary btn-sm bordered-25 px-3">
                                                Pogledaj detalje</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>


        </div>
    @endsection


    @push('js')
        <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tshirt').DataTable({
                    language: {
                        url: '/datatable.language.json'
                    }
                });
            });
        </script>
    @endpush
