<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
    

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div>
        <nav class="navbar-light shadow-sm m-5" style="background-color: #587c5b ">

            <ul class="nav justify-content-end">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/home') }}">Guest</a>
                </li>

                @if (Route::has('login'))

                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">Log
                                in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth

                @endif
            </ul>
        </nav>

    </div>
    <div class="text-center">
        <h1 class="display-1">Funding Platform</h1>
    </div>
    <div class="text-center">
        <img src="{{ url('/images/helping.jpg') }}" class="img-thumbnail" alt="Image" />
    </div>
    <div class="text-center">
        <p class="display-3">Help Me and I help You</p>
    </div>
    <div class="text-center">
        <img src="{{ url('/images/hands-logo.png') }}" alt="Image" width="60px" />
    </div>
</body>

</html>
