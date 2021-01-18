@extends("adminlte::page")
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Данные по заказу № {{ $order->id }}</h3>
                        </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <h3 class="mb-3">Состав заказа</h3>
                                <p>
                                    Статус заказа:
                                    @if ($order->status == 0)
                                        <span class="text-danger">{{ $statuses[$order->status] }}</span>
                                    @elseif (in_array($order->status, [1,2,3]))
                                        <span class="text-success">{{ $statuses[$order->status] }}</span>
                                    @else
                                        {{ $statuses[$order->status] }}
                                    @endif
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>№</th>
                                        <th>Наименование</th>
                                        <th>Цена</th>
                                        <th>Кол-во</th>
                                        <th>Стоимость</th>
                                    </tr>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->price, 2, '.', '') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->cost, 2, '.', '') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="4" class="text-right">Итого</th>
                                        <th>{{ number_format($order->amount, 2, '.', '') }}</th>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <h3 class="mb-3">Данные покупателя</h3>
                                <p>Имя, фамилия: {{ $order->name }}</p>
                                <p>Адрес почты: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
                                <p>Номер телефона: {{ $order->phone }}</p>
                                <p>Адрес доставки: {{ $order->address }}</p>
                                @isset ($order->comment)
                                    <p>Комментарий: {{ $order->comment }}</p>
                                @endisset
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
