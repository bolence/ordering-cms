@extends('layouts.app')


@section('content')
    <order-details-component order_id="{{ $order->id }}" />
@endsection
