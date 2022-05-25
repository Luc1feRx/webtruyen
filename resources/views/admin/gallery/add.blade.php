@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Ảnh</label>
          <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()" value="{{old('name')}}" placeholder="Nhập Tên Gallery" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control" value="{{old('slug')}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>


        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="description" id="ckeditor3" class="form-control" cols="30" rows="10">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Hình Ảnh</label>
              <input type="file" name="thumb" class="form-control">
          </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="1" name="active" checked>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="active">
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Gallery</button>
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
      
    </script>
@endsection
