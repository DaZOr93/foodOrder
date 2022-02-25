@extends('layouts.main')

@section('title', 'Профиль')

@section('content')
<div class="row gutters">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                <form method="post" action="{{route('profile.update', Auth::user()->id)}}">
                    @csrf
                    @method('PUT')
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Профиль</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите имя" value="{{ $user->name }}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email}}">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class="form-control" placeholder="+3801237290997" name="phone" value="{{ $user->phone}}">
                        </div>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password_confirmation">Пароль еще раз</label>
                            <input type="password" class="form-control" name="password_confirmation" >
                        </div>
                    </div>
                </div>
                <div class="row gutters mt-4">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="submit"  class="btn btn-primary">Обновить</button>
                        </div>
                    </div>
                </div>
                </form>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Address</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="Street">Street</label>
                            <input type="name" class="form-control" id="Street" placeholder="Enter Street">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="ciTy">City</label>
                            <input type="name" class="form-control" id="ciTy" placeholder="Enter City">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="sTate">State</label>
                            <input type="text" class="form-control" id="sTate" placeholder="Enter State">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="zIp">Zip Code</label>
                            <input type="text" class="form-control" id="zIp" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                            <button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
