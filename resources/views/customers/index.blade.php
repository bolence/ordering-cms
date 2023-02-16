@extends('layouts.app')


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
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ime mušterije</th>
                                    <th>Ime firme</th>
                                    <th>Email</th>
                                    <th>Ulica</th>
                                    <th>Grad</th>
                                    <th>Telefon</th>
                                    <th>Telefon 2</th>
                                    <th>Broj poruđbina</th>
                                    <th>Detalji</th>
                                    <th>Akcije</th>
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
                                        <td><a href="" class="btn btn-primary btn-sm radius-30 px-4">Detalji
                                            </a></td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="" class="ms-3"><i
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

    </div>
@endsection
