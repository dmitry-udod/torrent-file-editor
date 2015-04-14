<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>@yield('title', 'Redis admin')</title>

    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/main.css') !!}
</head>

<body>

@include('partials.nav')

<div class="container-fluid">
    <div class="row">
        <div class="main">
            @include('partials.notifications')
            @yield('content')
        </div>
    </div>

</div>

{!! HTML::script('js/jquery-1.11.2.min.js') !!}
{!! HTML::script('js/bootstrap.min.js') !!}
</body>
</html>
