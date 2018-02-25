@extends('layouts.app')

<link rel='stylesheet prefetch' href='css/index.css'>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">

                <div class="card-body">
                    @if (session('status'))
                        <div class="card-header">Welcome to chat!. Please login.</div>
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <chat-component></chat-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
