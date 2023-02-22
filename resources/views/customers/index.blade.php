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
                                Spisak mušterija - {{ $customers->count() }}
                            </h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0" id="customers">
                            <thead class="table-light">
                                <tr>
                                    <th>Ime mušterije</th>
                                    <th>Ime firme</th>
                                    <th>Email</th>
                                    <th>Ulica</th>
                                    <th>Grad</th>
                                    <th>Telefon</th>
                                    <th>Telefon 2</th>
                                    <th>Broj poruđžbina</th>
                                    <th>Detalji</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>
                                            {{ $customer->name }}
                                        </td>
                                        <td>{{ $customer->firma }}</td>
                                        <td>
                                            {{ $customer->email }}
                                        </td>
                                        <td>{{ $customer->street }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->phone2 }}</td>
                                        <td>{{ $customer->orders_count }}</td>
                                        <td><a href="/customers/{{ $customer->id }}"
                                                class="btn btn-primary btn-sm radius-30 px-4">Detalji
                                            </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            $('#customers').DataTable({
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
