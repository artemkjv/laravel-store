@extends("adminlte::page")
@section("content")
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список заказов</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($orders))
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>№</th>
                                            <th width="10%">Дата и время</th>
                                            <th width="5%">Статус</th>
                                            <th width="15%">Покупатель</th>
                                            <th width="18%">Адрес почты</th>
                                            <th width="18%">Номер телефона</th>
                                            <th width="18%">Пользователь</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    @if ($order->status == 0)
                                                        <span class="text-danger">{{ $statuses[$order->status] }}</span>
                                                    @elseif (in_array($order->status, [1,2,3]))
                                                        <span class="text-success">{{ $statuses[$order->status] }}</span>
                                                    @else
                                                        {{ $statuses[$order->status] }}
                                                    @endif
                                                </td>
                                                <td>{{ $order->name }}</td>
                                                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                                                <td>{{ $order->phone }}</td>
                                                <td>
                                                    @isset($order->user)
                                                        {{ $order->user->name }}
                                                    @endisset
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.order.edit', ['id' => $order ->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.order.show', ['id' => $order->id]) }}"
                                                       class="btn btn-success btn-sm float-left mr-1">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @else
                                <p>Заказов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $orders->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
