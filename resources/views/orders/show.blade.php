@extends('layouts.main')

@section('title', 'Мой заказ')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Мой заказ № {{$order->id}}</h2>
            <p class="lead">Здесь вы можете, посмотреть свой заказ.</p>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название товара</th>
                    <th scope="col">Цена за 1</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Всего</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->menu as $order_item)

                    <tr>
                        <th scope="row"> {{$loop->iteration}} </th>
                        <td> {{$order_item->pivot->name}} </td>
                        <td> {{$order_item->pivot->price}} </td>
                        <td>{{$order_item->pivot->quantity}} </td>
                        <td> {{$order_item->pivot->total_cost}} </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">Всего</td>
                    <td colspan="2">{{$order->order_price}} грн</td>
                </tr>
                </tfoot>
            </table>
            <p class="lead">Статус заказа: {{trans("order.status.$order->status")}} </p>
            <p class="lead">Адрес</p>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>{{$order->address}}</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
@endsection
