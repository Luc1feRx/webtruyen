@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-body">
        <label for="exampleInputEmail1">Cấp Quyền User: {{$user->name}}</label>
    </div>
    
    @if (isset($name_roles))
        <div class="card-body">
            <label for="exampleInputEmail1">Vai Trò Hiện Tại: {{$name_roles}}</label>
        </div>
    @endif
    <!-- form start -->
    <form action="{{ route('insertRole', ['id'=>$user->id]) }}" method="post">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
            <label class="form-check-label">Role: </label>
            @foreach ($roles as $r)
                @if (isset($column_roles))
                    <div class="form-check">
                        <input class="form-check-input" {{$column_roles->id == $r->id ? 'checked' : ''}} name="role" value="{{$r->id}}" type="radio">
                        <label class="form-check-label">{{$r->name}}</label>
                    </div> 
                @else
                    <div class="form-check">
                        <input class="form-check-input" value="{{$r->id}}" name="role" type="radio" id="{{$r->id}}">
                        <label class="form-check-label">{{$r->name}}</label>
                    </div> 
                @endif
            @endforeach
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Phân Vai Trò</button>
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

    {{-- <script type="text/javascript">
        $('body').on('submit', '#addNewUser', function (e) {
            e.preventDefault();
            let name = $('.name').val(); // khai bao va lay gia tri cua input name
            let email = $('.email').val(); // như trên
            let password = $('.password').val();

            let FormData = { //tạo 1 biến formData chuỗi json
                name: name,
                email: email,
                password: password
            }

            axios.post("{{ route('register') }}", FormData) //thêm 1 danh mục sử dụng axio giao tiếp với api
                .then(function (response) {
                    $('.name').val('');
                    $('.email').val('');
                    $('.password').val('');
                    console.log(response.data); //trả về response
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }); //thông báo
                    // setInterval(function () {
                    //     window.location.href = `http://127.0.0.1:8000/api/categories`;
                    // }, 1500); //sau khi thêm xong sau 1,5 giây sẽ tự động quay lại danh sách danh mục
                })
                .catch(function (error) {
                    if(error.response.data.errors.name){
                        $('#error').text(error.response.data.errors.name[0]);
                    }

                    if(error.response.data.errors.description){
                        $('#errorcr').text(error.response.data.errors.description[0]);
                    }
                });

        });
    </script> --}}
@endsection
