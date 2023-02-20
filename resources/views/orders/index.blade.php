@extends('layouts.app')
@push('css')
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
@endpush



@section('content')
    <div class="page-content">

        <div class="col-xl-12 mx-auto">

            <div class="card border-top border-bottom border-1 border-1 border-warning bordered-15 p-3">
                <div class="card-title d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-4">
                            <i class="bx bxs-user me-1 font-22 text-primary"></i>
                            Spisak svih porudžbina - {{ $orders->count() }} porudžbine
                        </h5>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tshirt">
                        <thead class="table-light">
                            <tr>
                                <th>Broj porudžbine</th>
                                <th>Poručio</th>
                                <th>Tip dostave</th>
                                <th>Broj porudžbina</th>
                                <th>Suma</th>
                                <th>Poručeno</th>
                                <th>Detalji</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->customer?->name }}</td>
                                    <td>{{ $order->delivery_type }}</td>
                                    <td>{{ $order->order_items_count ?? 0 }}</td>
                                    <td>{{ number_format($order->price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>
                                        <a href="/order/{{ $order->id }}">
                                            <b-icon icon="eye" variant="success" font-scale="1"></b-icon>
                                        </a>

                                        <b-icon icon="trash" variant="danger" font-scale="1"></b-icon>

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
            $('#tshirt').DataTable({
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
