<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group mb-4">
            {!! Form::label('name', 'Название блюда') !!}
            {!! Form::text('name', $menu->name ?? null, ['class' => 'form-control']) !!}
        </div>

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group mb-4">
            <label for="category_id">Категория</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option
                        @if(isset($menu->category_id))
                        {{ $category->id === $menu->category_id ? 'selected' : '' }}
                        @endif
                        value="{{ $category->id }}">{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group mb-4">
            {!! Form::label('description', 'Описание') !!}
            {!! Form::text('description', $menu->description ?? null, ['class' => 'form-control']) !!}
        </div>

        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group mb-4">
            {!! Form::label('price', 'Цена') !!}
            {!! Form::text('price', $menu->price ?? null, ['class' => 'form-control']) !!}
        </div>

        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group mb-4">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status">
                    <option
                        @if(isset($menu->status))
                        {{ 'active' === $menu->status ? 'selected' : '' }}
                        @endif
                        value="active">Активно
                    </option>
                    <option
                        @if(isset($menu->status))
                        {{ 'not active' === $menu->status ? 'selected' : '' }}
                        @endif
                        value="not active">Не активно
                    </option>
            </select>
        </div>

        @error('status')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if(isset($menu->picture))
            <img class="rounded-circle" src="{{asset("$menu->picture")}}" alt="Generic placeholder image" width="140" height="140">
        @endif

        <div class="form-group mb-4">
            {!! Form::label('image', 'Изображение блюда') !!}
            {!! Form::file('image')!!}

        </div>

        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
</div>
