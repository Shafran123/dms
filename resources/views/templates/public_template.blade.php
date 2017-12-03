<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset("https://use.fontawesome.com/cd29093529.js") }}"></script>
    <style>
        body {
            padding-top: 54px;
        }



        @media (min-width: 992px) {
            body {
                padding-top: 56px;
            }
        }

        /*html {*/
            /*position: relative;*/
            /*min-height: 100%;*/
        /*}*/
    </style>
    <title>{{ isset($title) ? $title : 'Unset Title' }}</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">DMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ isset($home) ? "active" : "" }}">
                    <a class="nav-link" href="{{ url('/') }}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item {{ isset($onMap) ? "active" : "" }}" href="{{ route('view_map') }}">On map</a>
                        <a class="dropdown-item {{ isset($onGraph) ? "active" : "" }}" href="{{ route('view_graph') }}">On graph</a>
                    </div>
                </li>
                <li class="nav-item {{ isset($contact) ? "active" : "" }}">
                    <a class="nav-link" href="{{ route("contact") }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

{{--<footer class="py-5 bg-dark">--}}
    {{--<div class="container">--}}
        {{--<p class="m-0 text-center text-white page-footer foo">Copyright &copy; Your Website 2017</p>--}}
    {{--</div>--}}
    {{--<!-- /.container -->--}}
{{--</footer>--}}

<script src="{{ asset("js/jquery-3.2.1.slim.min.js") }}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="{{ asset("js/popper.min.js") }}" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="{{ asset("js/bootstrap.min.js") }}" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>