@extends('layouts.app')

@section('content')

    <div class="panel-heading">Edit Pomodoro</div>

    <div class="panel-body">
        @include('pomodoros.form')
    </div>

@endsection