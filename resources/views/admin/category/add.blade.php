@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="" id="addNewCategory" method="post">
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Danh Mục
          <input type="text" class="form-control name" id="slug" onkeyup="ChangeToSlug()" value="{{old('name')}}" placeholder="Nhập Tên Danh Mục" name="name">
              <span id="error" class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control slug" value="{{old('slug')}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>


        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="description" id="ckeditor3" class="form-control description" cols="30" rows="10">{{old('name')}}</textarea>
            <span id="errorcr" class="text-danger"></span>
        </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input active" type="radio" value="1" name="active" checked>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input active" type="radio" value="0" name="active">
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
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
        $('body').on('submit', '#addNewCategory', function (e) {
            e.preventDefault();
            let name = $('.name').val(); // khai bao va lay gia tri cua input name
            let slug = $('.slug').val(); // như trên
            let description = $('.description').val();
            let active = $('.active').val();

            let FormData = { //tạo 1 biến formData chuỗi json
                name: name,
                slug: slug,
                description: description,
                active: active
            }

            axios.post("{{ route('category.store') }}", FormData) //thêm 1 danh mục sử dụng axio giao tiếp với api
                .then(function (response) {
                    $('.name').val('');
                    $('.slug').val('');
                    $('.description').val('');
                    $('.active').val('');
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
