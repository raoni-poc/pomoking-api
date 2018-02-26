<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link href="/css/sweetalert.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @include('layouts.css-head')
    @yield('css-top', '')

    <!-- Scripts -->
    @yield('scripts-head', '')
    @include('layouts.script-head')

    <!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>;
    </script>
</head>
<body class="with-navbar">
<div id="spark-app" v-cloak>
    <!-- Navigation -->
@if (Auth::check())
    @include('nav.user')
@else
    @include('nav.guest')
@endif

<!-- Main Content -->
    <home :user="user" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (Session::has('message'))
                        <div class="{{ Session::get('class') }}">{{ Session::get('message') }}</div>
                    @endif
                    <div class="panel panel-default">

                    @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </home>

<!-- Application Level Modals -->
    @if (Auth::check())
        @include('spark::modals.notifications')
        @include('spark::modals.support')
        @include('spark::modals.session-expired')
    @endif
</div>

<!-- CSS -->
@include('layouts.css-bottom')
@yield('css-bottom', '')

<!-- JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/sweetalert.min.js"></script>
@include('layouts.script-bottom')
@yield('scripts-bottom', '')
</body>
</html>
