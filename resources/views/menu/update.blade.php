@extends('layouts.main')

@section('title', 'Редактирование блюда')

@section('content')
    <div class="container">


        <div class="jumbotron">
            <h3 class="display-4">Редактирование блюда</h3>
            <p class="lead">Можно изменить картинку блюда</p>

            {!! Form::open(['method' => 'post' , 'url' => route('menu.update', $menu->id),'files' => true]) !!}
            @include('menu.form.fields')
            <div class="form-group">
                <a class="btn btn-success" href="{{ url()->previous() }}" role="button">Назад</a>
                {!! Form::submit('Обновить', ['class' => 'btn btn-success']); !!}
            </div>
            {!! Form::close() !!}
        </div>


    </div>
@endsection
