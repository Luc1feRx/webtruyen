@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-body">
        <label for="exampleInputEmail1">Cấp Quyền User: {{$user->name}}</label>
    </div>
    
    @if (empty($name_roles))
        <div class="card-body">
            <label for="exampleInputEmail1">Vai Trò Hiện Tại: Chưa có</label>
        </div>
    @else
        <div class="card-body">
            <label for="exampleInputEmail1">Vai Trò Hiện Tại: {{$name_roles}}</label>
        </div>
    @endif
    <!-- form start -->
    <form action="{{ route('insertPermission', ['id'=>$user->id]) }}" method="post">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
            <label class="form-check-label">Permission: </label>
           @foreach ($permissions as $p)
               <div class="form-check">
                   <input class="form-check-input" value="{{$p->name}}"
                   
                   @foreach ($get_permission_via_role as $item)
                       @if ($item->id == $p->id)
                        {{'checked'}}
                       @endif
                   @endforeach

                   name="permission[]" multiple type="checkbox" id="{{$p->id}}">
                   <label class="form-check-label">{{$p->name}}</label>
               </div>
           @endforeach
         </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Phân Quyền</button>
      </div>
    </form>
  </div>
@endsection

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('id4');
    </script>


@endsection
