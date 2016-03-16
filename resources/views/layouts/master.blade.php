<!DOCTYPE html>
<html>
    <head>
        <title>Twit Macet - @yield('title')</title>
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap-theme.min.css') }}">
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Twit Macet</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ url('/') }}">Maps</a></li>
                        <li><a href="{{ url('/tweets') }}">Tweets</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ url('assets/js/jquery-2.2.1.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    </body>
</html>