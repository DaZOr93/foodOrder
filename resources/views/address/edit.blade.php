@extends('layouts.main')

@section('title', 'Добавить адрес')

@section('content')
    <div class="row gutters">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <form method="post" action="{{route('address.update', $address->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Добавить адрес</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">Город</label>
                                    <input type="text" class="form-control" name="city" placeholder="Введите город"  value="{{ $address->city }}">
                                </div>
                                @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="street">Улица</label>
                                    <input type="text" class="form-control" name="street" placeholder="Введите улицу" value="{{ $address->street }}">
                                </div>
                                @error('street')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="house">Дом</label>
                                    <input type="text" class="form-control"  name="house" placeholder="Введите номер дома" value="{{ $address->house }}">
                                </div>
                                @error('house')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="apartment">Квартира</label>
                                    <input type="text" class="form-control" name="apartment" placeholder="Введите номер квартиры" value="{{ $address->apartment }}">
                                </div>
                                @error('apartment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row gutters mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <a href="{{ url()->previous() }}">
                                        <button type="button" id="submit" name="submit" class="btn btn-secondary">Назад</button>
                                    </a>
                                    <button type="submit" class="btn btn-primary">Создать</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
