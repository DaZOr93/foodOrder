@extends('layouts.main')

@section('title', 'Корзина')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Корзина</h2>
            <p class="lead">Здесь вы можете, редактировать корзину или и оформить заказ.</p>
@php
$basket_cost = 0;
@endphp
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Название товара</th>
                <th scope="col">Цена за 1</th>
                <th scope="col">Количество</th>
                <th scope="col">Всего</th>
                <th colspan="2" scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($basket as $basket_item)
                @php
                    $item_cost = $basket_item->quantity * $basket_item->menu->price;
                    $basket_cost = $basket_cost + $item_cost;
                @endphp
                <tr>
                    <th scope="row"> {{$loop->iteration}} </th>
                    <td> {{$basket_item->menu->name}} </td>
                    <td> {{$basket_item->menu->price}} </td>
                    <td>
                        <form action="{{ route('basket.add', ['menu_id' => $basket_item->menu->id]) }}" method="post" class="d-flex">
                            @csrf
                            <input type="number" name="quantity" max="20" min="1" value="{{$basket_item->quantity}}" class="form-control quantity" >
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Ок</button>
                        </form>
                    </td>
                    <td> {{$item_cost}} </td>
                    <td>
                        <form id="destroy-form" action=" {{route('basket.destroy', $basket_item->id)}} " method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить позицию?')" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего</td>
                <td colspan="2">{{$basket_cost}} грн</td>
            </tr>
            </tfoot>
        </table>
            <p class="lead">Адрес</p>
            <table class="table table-striped">
                <tbody>
                <form action="{{ route('orders.store') }}" method="post">
                @forelse($address as $address_item)
                    <tr>
                        <th scope="row"> {{$loop->iteration}} </th>
                        <td>
                            <input type="radio" name="address_id" value="{{$address_item->id}}">
                        </td>
                        <td> {{$address_item->city}}, {{$address_item->street}} {{$address_item->house}}
                            @if(isset($address_item->apartment))
                                {{'- '.$address_item->apartment}}
                            @endif
                        </td>
                    </tr>

                @empty
                @endforelse
                </tbody>
            </table>
            @csrf
            <button class="btn btn-primary btn-lg"  type="submit">Оформить заказ</button>
            </form>
        </div>
    </div>
@endsection
