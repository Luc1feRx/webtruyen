@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="{{ route('chapters.update', ['chapter'=>$chapters->id]) }}" method="post">
        @method('PUT')
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Chapter</label>
          <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()" value="{{$chapters->name}}" placeholder="Nhập Tên Chapter" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control" value="{{$chapters->slug}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>


        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="description" id="ckeditor3" class="form-control" cols="30" rows="10">{{$chapters->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Nội Dung</label>
              <textarea name="content" id="ckeditor2" class="form-control" cols="30" rows="10">{{$chapters->content}}</textarea>
          </div>

          <div class="form-group">
            <label>Truyện</label>
            <select class="form-control" name="book_id">
                @foreach ($books as $item)
                    <option {{$chapters->book_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
          </div>


        <div class="form-group">
            <label for="exampleInputFile">Kích Hoạt</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="1" name="active" {{$chapters->active == 1 ? 'checked' : ''}}>
              <label class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="active" {{$chapters->active == 0 ? 'checked' : ''}}>
                <label class="form-check-label">Không</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Chapter</button>
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
