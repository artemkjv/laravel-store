@extends("layouts.site")
@section("content")
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}</p>
    <p>Это личный кабинет постоянного покупателя нашего интернет-магазина.</p>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary" style="float: left; margin: 0 10px;">Выйти</button>
    </form>
    <a href="{{route("user.edit")}}" class="btn btn-success" style="float: left; margin: 0 10px;">Редактировать</a>
@endsection
