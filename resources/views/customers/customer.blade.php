@extends('layouts.app')


@section('content')
    <div class="page-content">
        <customer-order-details :customer_id="{{ $customer->id }}" />
    </div>
@endsection
