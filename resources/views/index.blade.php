@extends('layouts.main')

@section('title', 'Главная')

@section('content')
    <div class="px-3 py-2 border-bottom mb-3">
        <div class="container d-flex flex-wrap justify-content-center">
            <h4>Категории</h4>
            @auth
                @if(Auth::user()->role_id==1)
                <a class="category_edit" href="{{ route("category.index")}}">Ред.</a>
                @endif
            @endauth
        </div>
    </div>
    <div class="row">
        @foreach($categories as $category)
                <a href="{{ route("menu.category", ['category' => $category->id]) }}"
                   class="@if(isset($categoryId)){{ ($categoryId == $category->id) ? 'active' : '' }}@endif
                    col-lg-2 text-center category">
                    <img class="category rounded-circle" src="{{asset("$category->picture")}}" alt="Generic placeholder image" width="140" height="140">
                    <h6>{{$category->name}}</h6>
                </a>


        @endforeach

    </div>
            <div class="px-3 py-2 border-bottom border-top mb-3">
                <div class="container d-flex flex-wrap justify-content-center">
                    <h4>Меню</h4>
                    @auth
                        @if(Auth::user()->role_id==1)
                        <a class="category_edit" href="{{ route("menu.create")}}">Доб.</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="row">
                @foreach($menu as $menu_position)

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{asset("$menu_position->picture")}}" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text"> {{$menu_position->name}}</p>
                            <p class="category_menu card-text">{{$menu_position->category->name}} </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    @auth
                                    @if(Auth::user()->role_id==1)
                                    <a href="{{route('menu.edit', $menu_position->id) }}">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Редактировать</button>
                                    </a>
                                            <form id="destroy-form" action=" {{route('menu.destroy', $menu_position->id)}} " method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Удалить блюдо')" type="submit">Удалить</button>
                                            </form>
                                    @else
                                            <form action="{{ route('basket.add', ['menu_id' => $menu_position->id]) }}" method="post" class="d-flex">
                                                @csrf

                                            <input type="number" name="quantity" max="20" min="1" value="1" class="form-control quantity" >
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Добавить в корзину</button>

                                            </form>
                                    @endif
                                    @endauth
                                </div>
                                <small class="text-muted">{{$menu_position->price}} грн.</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


@endsection
