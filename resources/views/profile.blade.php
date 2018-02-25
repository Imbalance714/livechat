@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        Добро пожаловать, {{ $user->name }}!
                    </div>
                    <div class="card-block">
                        <div class="card-header">
                            Дата создания учётной записи: {{ $user->created_at }}
                        </div>
                        <form id="profile-form" action="{{ route('profile') }}" method="POST"
                              >
                            @csrf
                            <div class="card-header">
                                <input name="name" class="form-control" value="{{ $user->name }}" type="text"
                                       placeholder="Ваше имя">
                            </div>
                            <div class="card-header">
                                <input name="email" class="form-control" value="{{ $user->email }}" type="email" placeholder="Email">
                            </div>
                            <div class="card-header">
                                <a onclick="event.preventDefault();
                                    document.getElementById('profile-form').submit();"
                                    class="btn btn-success">Изменить данные</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
