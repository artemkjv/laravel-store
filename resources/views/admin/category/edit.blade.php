@extends("adminlte::page")
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование категории</h3>
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
                                           placeholder="Название" value="{{$category->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Описание</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{$category->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="parent_id">
                                        <option value="0" selected>Category</option>
                                        @foreach($categories as $value)
                                            <option value="{{$value->id}}" @if($category->parent_id == $value->id) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image">
                                </div>
                                <img src="{{asset("storage/$category->image")}}" width="200px" class="img-thumbnail">
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
