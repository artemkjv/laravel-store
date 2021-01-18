@extends("adminlte::page")
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование пользователя</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" enctype="multipart/form-data" method="post">
                            @method("PATCH")
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="Название" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Почта</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
