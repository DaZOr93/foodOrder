@extends('layouts.main')

@section('title', 'Мои заказы')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Мои закакзы</h2>
            <p class="lead">Здесь вы можете, посмотреть свои заказы.</p>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">№ заказа</th>
                <th scope="col">Дата заказа</th>
                <th scope="col">Сумма</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <th scope="row"> {{$loop->iteration}} </th>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}">
                            {{$order->id}}
                        </a>
                    </td>
                    <td> {{$order->created_at}} </td>
                    <td> {{$order->order_price}} </td>
                    <td> {{trans("order.status.$order->status")}} </td>
                </tr>
            @empty
                нет заказов
            @endforelse
        </div>
    </div>
    <div class="justify-content-center">
        {{$orders->links()}} </div>
@endsection
