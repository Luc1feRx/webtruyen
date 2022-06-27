@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="" method="post" data-id="" id="addNewUser">
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên User</label>
          <input type="text" class="form-control name" value="{{old('name')}}" placeholder="Nhập Tên user" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control email" value="{{old('email')}}" placeholder="Nhập Email" name="email">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="text" class="form-control password" value="{{old('password')}}" placeholder="Nhập password" name="password">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm User</button>
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

    <script type="text/javascript">
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
    </script>
@endsection
