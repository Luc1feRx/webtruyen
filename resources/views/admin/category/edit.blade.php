@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="" id="updateCategory" data-id="{{$categories->id}}" method="POST">
      @method('PUT')
         @csrf
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Danh Mục</label>
          <input type="text" class="form-control name" id="slug" onkeyup="ChangeToSlug()" value="{{$categories->name}}" placeholder="Nhập Tên Danh Mục" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control slug" value="{{$categories->slug}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="description" id="ckeditor3" class="form-control description" cols="30" rows="10">{{$categories->description}}</textarea>
        </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input active" type="radio" value="1" name="active" {{$categories->active == 1 ? 'checked' : ''}}>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input active" type="radio" value="0" name="active" {{$categories->active == 0 ? 'checked' : ''}}>
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa Danh Mục</button>
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
        $('body').on('submit', '#updateCategory', function (e) {
            e.preventDefault();
            let name = $('.name').val();
            let slug = $('.slug').val();
            let description = $('.description').val();
            let active = $('.active').val();
            let id = $(this).data('id');
            let url = window.location.origin + `/api/categories/update/${id}`;

            axios.put(url, {
                name: name,
                slug: slug,
                description: description,
                active: active,
            })
                .then(function (response) {
                    console.log(response.data);
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
