@extends('admin.master')


@section('content')
@include('admin.error.error')
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
            <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Hình Ảnh</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tên Truyện</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Danh Mục</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Kích Hoạt</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Truyện Nổi Bật</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Update</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$item->id}}</td>
                    <td><img src="{{ asset($item->thumb) }}" style="width: 150px; height: 210px" alt=""></td>
                    <td>{{$item->name}}</td>
                    <td>
                        @foreach ($item->book_in_multiple_cate as $cates)
                        <span class="badge badge-dark">
                            {{$cates->name}}
                        </span>
                        <br>
                        @endforeach
                    </td>
                    <td> {!! $item->active == 0 ? '<a href=""><span><i style="font-size: 23px; color: red;" class="fa fa-thumbs-down"></i></span></a>' : '<a href=""><span><i style="font-size: 23px; color: green;" class="fa fa-thumbs-up"></i></span></a>' !!} </td>
                    <td>
                        <div class="form-group">
                            <form>
                                {{ csrf_field() }}
                                <select name="hot_book" data-id="{{$item->id}}" class="form-control hot_books">
                                    <option value="0" {{$item->hot_book == 0 ? 'selected' : ''}}>Truyện Mới</option>
                                    <option value="1" {{$item->hot_book == 1 ? 'selected' : ''}}>Truyện Nổi Bật</option>
                                    <option value="2" {{$item->hot_book == 2 ? 'selected' : ''}}>Truyện Xem Nhiều</option>
                                </select>
                            </form>
                          </div>
                    </td>
                    <td>{{$item->updated_at}} - {{$item->updated_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('book.edit', ['book'=>$item->id]) }}"><i class="fas fa-edit"></i></a>
                        <a onclick="DeleteRow({{$item->id}}, `{{ route('book.destroy', ['book'=>$item->id]) }}`)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        {{-- <form action="{{ route('book.destroy', ['book'=>$item->id]) }}" method="post">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <button onclick="DeleteRow({{$item->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table></div></div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    {!! $books->links() !!}
                </div>
            </div>
        </div>


@endsection
