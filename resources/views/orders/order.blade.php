@extends('layouts.app')


@section('content')
    <div class="page-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary"
                                width="110">
                            <div class="mt-3">
                                <h4>Poručio/la: {{ $order->customer->name }}</h4>
                                @if ($order->customer->email)
                                    <a class="text-muted font-size-sm py-2">{{ $order->customer->email }}</a>
                                @endif
                                @if ($order->customer->phone)
                                    <p class="text-muted font-size-sm py-2">{{ $order->customer->phone }}</p>
                                @endif

                                <a class="btn btn-primary" href="mailto:{{ $order->customer->email }}">Pošalji
                                    poruku</a>
                            </div>
                        </div>
                        @if ($order->customer->street || $order->customer->city)
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Ulica</h6>
                                    <span class="text-secondary">{{ $order->customer->street }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Grad</h6>
                                    <span class="text-secondary">{{ $order->customer->city }}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card bordered-10">
                    <div class="card-header">
                        <h4>Detalji porudžbine <span class="text-primary fw-bold">{{ $order->order_number }}</span></h4>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tip dostave</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ ucfirst($order->delivery_type) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Datum porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"
                                    value="{{ $order->order_date->format('d.m.Y') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Poručeno sa</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ ucfirst($order->order_from) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Suma porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ number_format($order->price, 2) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Porudžbina kreirana</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"
                                    value="{{ $order->created_at->format('d.m.Y H:m') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Status porudžbine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select class="form-select" id="status" name="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            @if ($status->id == $order->status_id) selected @endif>{{ $status->status }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        @if ($order->delivery_type == 'dostava')
                            <h5 class="text-primary">Detalji slanja</h5>
                            <hr />
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ime i prezime kome se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $order->delivery->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ulica gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $order->delivery->street }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Grad gde se šalje</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $order->delivery->city }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefon za kontakt</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $order->delivery->phone }}">
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-12text-secondary">
                                <input type="button" class="btn btn-primary px-4 float-end" value="Snimi izmene">
                            </div>
                        </div>
                    </div>
                </div>
                @if ($order->order_items->count())
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card bordered-10">
                                <div class="card-body">
                                    <div class="card-header mb-0">
                                        <h5 class="d-flex align-items-center mb-1">Porudžbina sadrži
                                            {{ $order->order_items->sum('quantity') }} proizvoda</h5>
                                    </div>

                                    <table id="badges" class="table table-bordered my-3" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Tip</th>
                                                <th>Veličina bedža/majice</th>
                                                <th>Tip kačenja/ Boja majice</th>
                                                <th>Plastifikacija/Tip majice</th>
                                                <th>Količina</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($order->order_items as $order_item)
                                                <tr>
                                                    <td class="fw-bold">{{ ucfirst($order_item->type) }}</td>
                                                    <td>{{ $order_item->badge_size ? $order_item->badge_size . 'mm' : strtoupper($order_item->tshirt_size) }}
                                                    </td>
                                                    <td>{{ $order_item->tip_kacenja ? json_encode($order_item->tip_kacenja) : ucfirst($order_item->tshirt_color) }}
                                                    </td>
                                                    <td>{{ $order_item->plastifikacija && $order_item->type == 'bedž' ? ucfirst($order_item->plastifikacija) : ucfirst($order_item->tshirt_type) }}
                                                    </td>
                                                    <td>{{ $order_item->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
