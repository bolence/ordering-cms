@extends('layouts.app')
@push('css')
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <style>
        .dataTables_length,
        .dataTables_filter {
            padding-bottom: 20px;
        }

        thead>tr {
            font-size: 15px !important;
        }

        tbody>tr>td {
            font-size: 17px !important;
        }

        .dtr-details {
            font-size: 17px !important;
        }
    </style>
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
                    <a style="font-size: 15px;" href="/pdf/order/today">
                        <b-icon icon="printer-fill" variant="info" font-scale="1.5"></b-icon> Današnje porudžbine
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tshirt">
                        <thead class="table-light">
                            <tr>
                                <th>Poručio</th>
                                <th>Broj porudžbine</th>
                                <th>Tip dostave</th>
                                <th>Status</th>
                                <th>Broj proizvoda</th>
                                <th>Suma</th>
                                <th>Poručeno</th>
                                <th>Detalji</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->customer?->name }}</td>
                                    <td>{{ $order->order_number }}</td>

                                    <td>{{ $order->delivery_type }}</td>
                                    <td><span
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>{{ $order->status->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->order_items_count ?? 0 }}</td>
                                    <td>{{ number_format($order->price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>
                                        <a href="/order/{{ $order->id }}">
                                            <b-icon icon="eye-fill" variant="success" font-scale="1"></b-icon>
                                        </a>
                                        <a href="" data-id="{{ $order->id }}" class="delete_row">
                                            <b-icon icon="trash-fill" variant="danger" font-scale="1"></b-icon>
                                        </a>
                                        <a href="/pdf/order/{{ $order->id }}">
                                            <b-icon icon="printer-fill" variant="info" font-scale="1"></b-icon>
                                        </a>
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
                order: [
                    [1, 'desc']
                ],
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

            $('.delete_row').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm('Da li ste sigurni za brisanje?')) {
                    $.ajax({
                        url: `/api/orders/${id}`,
                        type: 'DELETE',
                        success: function(result) {
                            alert('Porudžbina izbrisana');
                            window.location.href = "/order"
                        }
                    });
                }
            })
        });
    </script>
@endpush
