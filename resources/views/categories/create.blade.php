@extends('layouts.main')

@section('title', 'Создать категорию')

@section('content')
    <div class="container">


        <div class="jumbotron">
            <h3 class="display-4">Добавление категории</h3>
            <p class="lead">При добавлении категории не забудь про картинку</p>

            {!! Form::open(['url' => route('category.store'),'files' => true]) !!}
            @include('categories.form.fields')
            <div class="form-group">
                <a class="btn btn-success" href="{{ url()->previous() }}" role="button">Назад</a>
                {!! Form::submit('Добавить', ['class' => 'btn btn-success']); !!}
            </div>
            {!! Form::close() !!}
        </div>


    </div>
@endsection
