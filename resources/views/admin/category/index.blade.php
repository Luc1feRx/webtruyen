@extends('admin.master')


@section('content')
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
            <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tên Danh Mục</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Kích Hoạt</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
            </table></div></div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>


@endsection

            @section('footer')

                //get data đưa lên tbody ở trên
                <script type="text/javascript">
                    function get_table(data) {
                        let urlUpdate = "";
                        let id = 0;
                        $.each(data, function (key, value) { //duyệt mảng phần tử danh mục
                            id = value.id;
                            urlUpdate = `categories/edit/${id}`;
                            if(value.active === 0){
                                $('#tbody').append('<tr class="odd"> ' +
                                    '<td class="dtr-control sorting_1" id="IDCategory" tabindex="0">'+ value.id +'</td> ' +
                                    '<td>'+ value.name +'</td> ' +
                                    '<td><a href=""><span><i style="font-size: 23px; color: red;" class="fa fa-thumbs-down"></i></span></a></td>'  +
                                    '<td>'+
                                    '<a class="btn btn-primary btn-sm" href="'+ urlUpdate +'"><i class="fas fa-edit"></i></a>' +
                                    '<button class="btn btn-danger btn-sm" id="btnDelete" data-id="'+ value.id +'"><i class="fas fa-trash-alt"></i></button>' +
                                '</td>' +
                            '</tr>'); //trả về danh sách danh mục lên tbody
                            }else{
                                $('#tbody').append('<tr class="odd"> ' +
                                    '<td class="dtr-control sorting_1" id="IDCategory" tabindex="0">'+ value.id +'</td> ' +
                                    '<td>'+ value.name +'</td> ' +
                                    '<td><a href=""><span><i style="font-size: 23px; color: green;" class="fa fa-thumbs-up"></i></span></a></td>'  +
                                    '<td>'+
                                    '<a class="btn btn-primary btn-sm" href="'+ urlUpdate +'"><i class="fas fa-edit"></i></a>' +
                                    '<button class="btn btn-danger btn-sm" id="btnDelete" data-id="'+ value.id +'"><i class="fas fa-trash-alt"></i></button>' +
                                    '</td>' +
                                    '</tr>');
                            }
                            {{--<a class="btn btn-primary btn-sm" href="{{ route('category.edit', ['category'=>$item->id]) }}"><i class="fas fa-edit"></i></a>--}}
                            {{--<a onclick="DeleteRow({{$item->id}}, `{{ route('category.destroy', ['category'=>$item->id]) }}`)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>--}}

                        });
                    }

                    //sử dụng axios để tương tác với url để lấy dữ liệu
                    function GetAllCategory(){
                        axios.get("{{route('category.getAll')}}")
                            .then(function (response) {
                                get_table(response.data.data); // truyền dữ liệu để hiện thị lên tbody
                                console.log(response.data.data);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                    GetAllCategory();
                </script>

            {{--delete categories--}}
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#tbody").on('click', "#btnDelete", function() {
                            let id = $(this).data('id'); //get id
                            let url = window.location.origin + `/api/categories/delete/${id}`;
                            Swal.fire({
                                title: 'Thông Báo',
                                text: "Bạn Chắc Chứ?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Xóa'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        axios.delete(url)
                                .then(function (response) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: response.data.message,
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                            setInterval(function () {
                                                window.location.href = `http://127.0.0.1:8000/categories`;
                                            }, 1500);
                                        })
                                        .catch(function (error) {
                                            console.log(error);
                                        });
                                        }
                                    }
                                );
                        });
                    });
                </script>
            {{--end delete categories--}}

@endsection
