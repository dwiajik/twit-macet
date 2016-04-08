<!DOCTYPE html>
<html>
    <head>
        <title>Twit Macet - @yield('title')</title>
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
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
                        <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{{ url('/') }}">Maps</a></li>
                        <li class="{{ (Request::is('tweets') ? 'active' : '') }}"><a href="{{ url('/tweets') }}">Tweets</a></li>
                        <li class="{{ (Request::is('analytics') ? 'active' : '') }}"><a href="{{ url('/analytics') }}">Analytics</a></li>
                        <li class="{{ (Request::is('about') ? 'active' : '') }}"><a href="{{ url('/about') }}">About</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="margin-navbar">
            @yield('content')
        </div>
        <script src="{{ url('assets/js/jquery-2.2.1.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        @stack('scripts')
    </body>
</html>