@extends('layouts.main')

@section('title', 'Категории')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">Список категорий</h2>
            <p class="lead">Здесь вы можете добавлять, редактировать и удалять категории.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('category.create') }}" role="button">Добавить категорию</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название категории</th>
                <th scope="col">Картинка</th>
                <th colspan="2" scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <th scope="row"> {{$category->id}} </th>
                    <td> {{$category->name}} </td>
                    <td> <img class="rounded-circle category" src="{{asset("$category->picture")}}" alt="Generic placeholder image" width="140" height="140"></td>
                    <td>
                        <a class="btn btn-primary mt-3 mb-3 btn-sm" href="{{route('category.edit', $category->id) }} ">Редактировать</a>

                        <form id="destroy-form" action=" {{route('category.destroy', $category->id)}} " method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить категорию?')" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="justify-content-center">
         {{$categories->links()}} </div>
@endsection
