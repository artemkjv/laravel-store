@extends("adminlte::page")
@section("content")
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список категорий</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Добавить
                                категорию</a>
                            @if (count($categories))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Наименование</th>
                                            <th>Описание</th>
                                            <th>Slug</th>
                                            <th>Actions</th>
                                            <th>Дочерние категории</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ Str::limit($category->content, 40, '...') }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i
                                                                class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @if($category->categories->count())
                                                <td>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover text-nowrap">
                                                            <thead>
                                                            <tr>
                                                                <th>Наименование</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($category->categories as $subcategory)
                                                                <tr>
                                                                    <td>{{ $subcategory->name }}</td>
                                                                    <td>
                                                                        <a href="{{ route('admin.category.edit', ['id' => $subcategory->id]) }}"
                                                                           class="btn btn-info btn-sm float-left mr-1">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                        </a>

                                                                        <form
                                                                            action="{{ route('admin.category.delete', ['id' => $subcategory->id]) }}"
                                                                            method="post" class="float-left">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                                    onclick="return confirm('Подтвердите удаление')">
                                                                                <i
                                                                                    class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Категорий пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $categories->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
