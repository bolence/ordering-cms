@extends('layouts.app')
@push('css')
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
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
                                Spisak poručenih bedževa - {{ $orders->count() }} porudžbine
                            </h5>
                        </div>
                    </div>

                    <div>
                        <table id="badges" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Broj porudžbine</th>
                                    <th>Veličina bedža</th>
                                    <th>Tip kačenja</th>
                                    <th>Plastifikacija</th>
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
                                        <td>{{ $order->badge_size }}</td>
                                        <td>{{ implode($order->tip_kacenja) }}</td>
                                        <td>{{ ucfirst($order->plastifikacija) }}</td>
                                        <td>{{ $order->order->customer->name }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ number_format($order->order->price, 2) }}</td>
                                        <td>{{ $order->order->order_date->format('d.m.Y') }}</td>
                                        <td>
                                            <div class="d-flex
                            order-actions">
                                                <a href="/order/{{ $order->order->id }}" class=""><i
                                                        class="bx bx-smile text-info"></i></a>
                                                <a href="javascript:;" class="ms-3"><i
                                                        class="bx bxs-trash text-danger"></i></a>
                                            </div>
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
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#badges').DataTable({
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Detalji porudžbine ' + data[0];
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                        }
                    },
                    language: {
                        url: '/datatable.language.json'
                    }
                });
            });
        </script>
    @endpush
