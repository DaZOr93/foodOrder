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
                                    <input type="text" class="form-control" name="name" placeholder="Введите имя"
                                           value="{{ $user->name }}">
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
                                    <input type="text" class="form-control" placeholder="+3801237290997" name="phone"
                                           value="{{ $user->phone}}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Пароль еще раз</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Список адресов</h6>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Адрес</th>
                                <th colspan="2" scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($address as $address_item)
                                <tr>
                                    <th scope="row"> {{$loop->iteration}} </th>
                                    <td> {{$address_item->city}}, {{$address_item->street}} {{$address_item->house}}
                                        @if(isset($address_item->apartment))
                                        {{'- '.$address_item->apartment}}
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-primary mt-3 mb-3 btn-sm"
                                           href="{{route('address.edit', $address_item->id) }} ">Редактировать</a>

                                        <form id="destroy-form"
                                              action=" {{route('address.destroy', $address_item->id)}} " method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Удалить адрес?')" type="submit">Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                        <a class="btn btn-primary btn-lg" href="{{ route('address.create') }}" role="button">
                            Добавить адрес
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
