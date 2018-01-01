
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? $title : 'Page not found' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="{{ asset("https://use.fontawesome.com/cd29093529.js") }}"></script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        {{--<h1>403</h1>--}}
        <div class="title">
            {{ isset($message) ? $message : 'Sorry, the page you are looking for could not be found' }}
        </div>
        <a href="{{ route('home') }}" style="text-decoration: none; color: grey;">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span style="font-weight: bold">Go back home</span>
        </a>
    </div>
</div>
</body>
</html>
