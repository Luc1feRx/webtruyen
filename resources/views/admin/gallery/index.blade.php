@extends('admin.master')


@section('content')
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
            <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Hình Ảnh</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tên Ảnh</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Mô Tả</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Kích Hoạt</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Update</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($galleries as $gallery)
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$gallery->id}}</td>
                    <td><img src="{{ asset($gallery->image) }}" style="width: 250px; height: 210px" alt=""></td>
                    <td>{{$gallery->name}}</td>
                    <td>
                        {!!$gallery->description!!}
                    </td>
                    <td> {!! $gallery->active == 0 ? '<a href=""><span><i style="font-size: 23px; color: red;" class="fa fa-thumbs-down"></i></span></a>' : '<a href=""><span><i style="font-size: 23px; color: green;" class="fa fa-thumbs-up"></i></span></a>' !!} </td>
                    <td>{{$gallery->updated_at}} - {{$gallery->updated_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('galleries.edit', ['gallery'=>$gallery->id]) }}"><i class="fas fa-edit"></i></a>
                        <a onclick="DeleteRow({{$gallery->id}}, `{{ route('galleries.destroy', ['gallery'=>$gallery->id]) }}`)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        {{-- <form action="{{ route('book.destroy', ['book'=>$item->id]) }}" method="post">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <button onclick="Delete({{$item->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table></div></div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    {!! $galleries->links() !!}
                </div>
            </div>
        </div>


@endsection