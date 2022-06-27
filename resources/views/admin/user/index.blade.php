@extends('admin.master')


@section('content')
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
            <tr>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tên User</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Password</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Roles</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Permission</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->password}}</td>
                    <td>
                        @foreach ($item->roles as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-success">{{$permission->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('ApproveRole', ['id'=>$item->id]) }}">Phân Vai Trò</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('ApprovePermission', ['id'=>$item->id]) }}">Phân Quyền</a>
                        <a class="btn btn-danger btn-sm">Chuyển Quyền Nhanh</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12 col-md-5">

                </div>
            </div>
        </div>
    </div>

        </div>


@endsection
