@extends('layouts.main')

@section('title', 'Создать категорию')

@section('content')
    <div class="container">


        <div class="jumbotron">
            <h3 class="display-4">Редактирование категории</h3>
            <p class="lead">Можно изменить картинку категории</p>

            {!! Form::open(['method' => 'post' , 'url' => route('category.update', $category->id),'files' => true]) !!}
            @include('categories.form.fields')
            <div class="form-group">
                <a class="btn btn-success" href="{{ url()->previous() }}" role="button">Назад</a>
                {!! Form::submit('Обновить', ['class' => 'btn btn-success']); !!}
            </div>
            {!! Form::close() !!}
        </div>


    </div>
@endsection
