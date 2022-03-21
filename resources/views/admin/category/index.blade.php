@extends('admin.master')


@section('content')
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
            <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tên Danh Mục</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Kích Hoạt</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Update</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td> {!! $item->active == 0 ? '<a href=""><span><i style="font-size: 23px; color: red;" class="fa fa-thumbs-down"></i></span></a>' : '<a href=""><span><i style="font-size: 23px; color: green;" class="fa fa-thumbs-up"></i></span></a>' !!} </td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('category.edit', ['category'=>$item->id]) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('category.destroy', ['category'=>$item->id]) }}" method="post">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <button onclick="return confirm('Are you sure you want to destroy this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table></div></div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>


@endsection
