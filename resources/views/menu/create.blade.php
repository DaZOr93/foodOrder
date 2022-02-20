@extends('layouts.main')

@section('title', 'Создать категорию')

@section('content')
    <div class="container">


        <div class="jumbotron">
            <h3 class="display-4">Добавление блюда</h3>
            <p class="lead">При добавлении блюда не забудь про картинку</p>

            {!! Form::open(['url' => route('menu.store'),'files' => true]) !!}
            @include('menu.form.fields')
            <div class="form-group">
                <a class="btn btn-success" href="{{ url()->previous() }}" role="button">Назад</a>
                {!! Form::submit('Добавить', ['class' => 'btn btn-success']); !!}
            </div>
            {!! Form::close() !!}
        </div>


    </div>
@endsection
