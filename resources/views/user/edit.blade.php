@extends("layouts.site")
@section("content")
    <h1>Редактировать аккаунт</h1>
    <form method="post">
        @method("PATCH")
        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтвержедние пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
@endsection
