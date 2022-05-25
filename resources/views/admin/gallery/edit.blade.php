@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    {{-- {{ route('sliders.update', ['slider'=>$sliders->id]) }} --}}
    <form action="{{ route('galleries.update', ['gallery'=>$gallery->id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Ảnh</label>
          <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()" value="{{$gallery->name}}" placeholder="Nhập Tên Slider" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control" value="{{$gallery->slug}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>


        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="description" id="ckeditor3" class="form-control" cols="30" rows="10">{{$gallery->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Hình Ảnh</label>
              <input type="file" name="thumb" class="form-control" value="{{ asset($gallery->image) }}">
              <div id="image_show">
                <img src="{{ asset($gallery->image) }}" alt="" style="width: 140px; height: 200px">
            </div>
          </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="1" name="active" {{$gallery->active == 1 ? 'checked' : ''}}>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="active" {{$gallery->active != 1 ? 'checked' : ''}}>
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa Gallery</button>
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
