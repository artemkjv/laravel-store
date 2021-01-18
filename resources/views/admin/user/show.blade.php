@extends("adminlte::page")
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="my-3">Данные пользователя</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="lead">Имя: {{$user->name}}</p>
                            <p class="lead">Почта: {{$user->email}}</p>
                            <p class="lead">Дата создания: {{$user->created_at->format("d.m.y H:i")}}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if(!empty($user->orders[0]))
                            <h3 class="my-3">Список заказов</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th>№</th>
                                    <th>Имя</th>
                                    <th>Почта</th>
                                    <th>Стоимость</th>
                                    <th>Статус</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($user->orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="text-danger">{{ $statuses[$item->status] }}</span>
                                            @elseif (in_array($item->status, [1,2,3]))
                                                <span class="text-success">{{ $statuses[$item->status] }}</span>
                                            @else
                                                {{ $statuses[$item->status] }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.order.edit', ['id' => $item ->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('admin.order.show', ['id' => $item->id]) }}"
                                               class="btn btn-success btn-sm float-left mr-1">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <form action="{{ route('admin.user.delete', ["id" => $user->id]) }}" method="post" class="text-right">
                                @method("delete")
                                @csrf
                                <button type="submit" class="btn btn-outline-danger mb-4 mt-0">
                                    Удалить пользователя
                                </button>
                            </form>
                            @endif
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
