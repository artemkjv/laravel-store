@extends("adminlte::page")
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование заказа</h3>
                        </div>
                        <!-- /.card-header -->

                            <div class="card-body">
                                <form method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        @php($status = old('status') ?? $order->status ?? 0)
                                        <select name="status" class="form-control" title="Статус заказа">
                                            @foreach ($statuses as $key => $value)
                                                <option value="{{ $key }}" @if ($key == $status) selected @endif>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                                               required maxlength="255" value="{{ old('name') ?? $order->name ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                                               required maxlength="255" value="{{ old('email') ?? $order->email ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone" placeholder="Номер телефона"
                                               required maxlength="255" value="{{ old('phone') ?? $order->phone ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" placeholder="Адрес доставки"
                                               required maxlength="255" value="{{ old('address') ?? $order->address ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" placeholder="Комментарий"
                                        maxlength="255" rows="2">{{ old('comment') ?? $order->comment ?? '' }}
                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
