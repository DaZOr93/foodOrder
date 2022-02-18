@extends('layouts.main')

@section('title', 'Главная')

@section('content')
    <div class="px-3 py-2 border-bottom mb-3">
        <div class="container d-flex flex-wrap justify-content-center">
            <h4>Категории</h4>
            <a href="{{ route("category.index")}}">Редактировать</a>
        </div>
    </div>
    <div class="row">
        @foreach($categories as $category)
                <a href="{{ route("menu.category", ['category' => $category->id]) }}" class=" col-lg-2 text-center">
                    <img class="rounded-circle" src="https://eda.ru/img/eda/c180x180/s1.eda.ru/StaticContent/Photos/120214142532/120214153837/p_O.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h6>{{$category->name}}</h6>
                </a>


        @endforeach

    </div>
            <div class="px-3 py-2 border-bottom border-top mb-3">
                <div class="container d-flex flex-wrap justify-content-center">
                    <h4>Меню</h4>
                </div>
            </div>
            <div class="row">
                @foreach($menu as $menu_position)

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22288%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20288%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17efe4214c2%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17efe4214c2%22%3E%3Crect%20width%3D%22288%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.84375%22%20y%3D%22118.8%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">{{$menu_position->category->name}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">{{$menu_position->price}} грн.</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

    <img src="" alt="">

@endsection
