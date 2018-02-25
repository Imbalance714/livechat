@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        @if($rooms->isEmpty())
                            <h2>Комнат не найдено</h2>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Имя</th>
                                <th scope="col">Создана</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <th scope="row">{{$room->id}}</th>
                                        <td>{{$room->name}}</td>
                                        <td>{{$room->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
