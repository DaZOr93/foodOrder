@extends('layouts.main')

@section('title', 'Управление заказами')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Управление заказами</h2>
            <p class="lead">Здесь вы можете, управлять заказами.</p>

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
                        <a href="{{ route('orders.dashboard_show', $order->id) }}">
                            {{$order->id}}
                        </a>
                    </td>
                    <td> {{$order->created_at}} </td>
                    <td> {{$order->order_price}} </td>
                    <td>
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
                    </td>
                </tr>
            @empty
                нет заказов
            @endforelse
        </div>
    </div>
    <div class="justify-content-center">
        {{$orders->links()}} </div>

@endsection
