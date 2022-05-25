@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="{{ route('book.update', ['book' => $books->id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Truyện</label>
          <input type="text" class="form-control" id="slug" value="{{$books->name}}" onkeyup="ChangeToSlug()" placeholder="Nhập Tên Truyện" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tên Tác Giả</label>
            <input type="text" class="form-control" value="{{$books->author}}" placeholder="Nhập Tên Tác Giả" name="author">
         </div>

        <div class="form-group">
            <label for="exampleInputFile">Tóm Tắt Truyện</label>
              <textarea name="summary" class="form-control" cols="30" rows="10">{{$books->summary}}</textarea>
          </div>


        <div class="form-group">
          <label for="exampleInputFile">Mô Tả Truyện</label>
            <textarea name="description" id="ckeditor3" class="form-control" cols="30" rows="10">{{$books->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control" value="{{$books->slug}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>

        <div class="form-group">
            <label>Danh Mục</label>
            <br>
            <div class="form-check form-check-inline">
                @foreach ($categories as $item)
                    <div class="form-group px-1">
                        <input class="form-check-input" name="categories[]"

                        @if ($byCates->contains($item->id))
                            checked
                        @endif

                        type="checkbox" id="cate_{{$item->id}}" value="{{$item->id}}">
                        <label class="form-check-label" for="cate_{{$item->id}}">{{$item->name}}</label>
                    </div>
                @endforeach
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputFile">Hình Ảnh</label>
            <input type="file" class="form-control" name="new_thumb" value="{{$books->thumb}}" id="upload">
            <div id="image_show">
                <img src="{{ asset($books->thumb) }}" alt="" style="width: 140px; height: 200px">
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Truyện Nổi Bật/HOT</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="0" name="hot_book" {{$books->hot_book == 0 ? 'checked' : ''}}>
              <label class="form-check-label">Truyện Mới</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="hot_book" {{$books->hot_book == 1 ? 'checked' : ''}}>
                <label class="form-check-label">Truyện Nổi Bật</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="2" name="hot_book" {{$books->hot_book == 2 ? 'checked' : ''}}>
                <label class="form-check-label">Truyện Xem Nhiều</label>
            </div>
          </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="1" name="active" {{$books->active == 1 ? 'checked' : ''}}>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="active" {{$books->active != 1 ? 'checked' : ''}}>
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa Truyện</button>
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
