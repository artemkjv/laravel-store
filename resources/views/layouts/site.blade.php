<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Магазин</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset("fontawesome/css/all.css")}}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Бренд и кнопка «Гамбургер» -->
    <a class="navbar-brand" href="/">Магазин</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbar-example" aria-controls="navbar-example"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
    <div class="collapse navbar-collapse" id="navbar-example">
        <!-- Этот блок расположен слева -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route("catalog")}}">Каталог</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Доставка</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Контакты</a>
            </li>
        </ul>

        <!-- Этот блок расположен справа -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link @if ($positions) text-success @endif" href="{{ route('basket') }}">
                    Корзина
                    @if ($positions) ({{ $positions }}) @endif
                </a>
            </li>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('user.login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                {{ __('Личный кабинет') }}
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </ul>
    </div>
</nav>
<div class="container" style="margin: 5em auto;">

    <div class="row">
        <div class="col-md-3">
        @include('layouts.part.roots')
        @include('layouts.part.brands')
        <!--
        <h4>Разделы каталога</h4>
        <p>Здесь будут корневые разделы</p>
        <h4>Популярные бренды</h4>
        <p>Здесь будут популярные бренды</p>
        -->
        </div>
        <div class="col-md-9">
            @if ($message = session()->has('success'))
                <div class="alert alert-success alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
