@extends('layouts.main')

@section('title', 'Пользователи')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Список пользователей</h2>
            <p class="lead">Здесь вы можете, управлять пользователями.</p>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">E-mail</th>
                <th scope="col">Роль</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="row"> {{$user->id}} </th>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}} </td>
                    <td> {{$user->role->name}} </td>
                    <td>
                        <a href="{{route('user.edit', $user->id) }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Ред</button>
                        </a>
                    </td>
                </tr>
            @empty
                нет пользователей
            @endforelse
        </div>
    </div>
    <div class="justify-content-center">
        {{$users->links()}} </div>
@endsection
