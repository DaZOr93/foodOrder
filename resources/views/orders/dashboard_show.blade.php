@extends('layouts.main')

@section('title', "Заказ № $order->id")

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Заказ № {{$order->id}}</h2>
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
            <p class="lead">Статус заказа:
            <form action="{{ route('orders.status', ['id' => $order->id]) }}" method="post" class="d-flex">
                @csrf
                <select class="form-control" id="category_id" name="status">
                    <option value="new" {{ 'new' === $order->status ? 'selected' : '' }}>
                        Новый
                    </option>
                    <option value="processing" {{ 'processing' === $order->status ? 'selected' : '' }}>
                        В процессе
                    </option>
                    <option value="delivered" {{ 'delivered' === $order->status ? 'selected' : '' }}>
                        В доставке
                    </option>
                    <option value="completed" {{ 'completed' === $order->status ? 'selected' : '' }}>
                        Выполнен
                    </option>
                    <option value="canceled" {{ 'canceled' === $order->status ? 'selected' : '' }}>
                        Отменен
                    </option>
                </select>
                <button type="submit" class="btn btn-sm btn-outline-secondary">Ок</button>
            </form>
            </p>
            <p class="lead">Данные доставки</p>
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>Адрес : {{$order->address}}</td>
                </tr>
                <tr>
                    <td>Телефон : {{$order->phone}}</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
@endsection
