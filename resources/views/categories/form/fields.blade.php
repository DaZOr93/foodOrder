<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group mb-4">
            {!! Form::label('name', 'Имя категории') !!}
            {!! Form::text('name', $category->name ?? null, ['class' => 'form-control']) !!}
        </div>

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if(isset($category->picture))
            <img class="rounded-circle" src="{{asset("$category->picture")}}" alt="Generic placeholder image" width="140" height="140">
        @endif

        <div class="form-group mb-4">
            {!! Form::label('image', 'Изображение категории') !!}
            {!! Form::file('image')!!}

        </div>

        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
</div>
