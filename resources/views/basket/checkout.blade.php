@extends('layouts.site')

@section('content')
    <h1 class="mb-4">Оформить заказ</h1>
    <form method="post">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Номер телефона"
                   required maxlength="255" value="{{ old('phone') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2">{{ old('comment') ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Оформить</button>
        </div>
    </form>
@endsection
