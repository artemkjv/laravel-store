@extends("adminlte::page")
@section("content_header")
    <p class="lead">Добро пожаловать, {{ auth()->user()->name }}.</p>
    <p class="lead">Это панель управления для администратора интернет-магазина.</p>
@endsection
