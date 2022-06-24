@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">

    <!-- form start -->
    <form action="{{route('book.store')}}" enctype="multipart/form-data" method="post" id="addNewBook">
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Truyện</label>
          <input type="text" class="form-control name" id="slug" onkeyup="ChangeToSlug()" value="{{old('name')}}" placeholder="Nhập Tên Truyện" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tên Tác Giả</label>
            <input type="text" class="form-control author" value="{{old('author')}}" placeholder="Nhập Tên Tác Giả" name="author">
          </div>

        <div class="form-group">
            <label for="exampleInputFile">Tóm Tắt Truyện</label>
              <textarea name="summary" class="form-control summary" cols="30" rows="10">{{old('summary')}}</textarea>
          </div>

        <div class="form-group">
          <label for="exampleInputFile">Mô Tả Truyện</label>
            <textarea name="description" id="ckeditor3" class="form-control description" cols="30" rows="10">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" class="form-control slug" value="{{old('slug')}}" placeholder="Nhập Slug" name="slug" id="convert_slug">
        </div>

        <div class="form-group">
            <label>Danh Mục</label>
            <br>
            <div class="form-check form-check-inline">
                @foreach ($categories as $item)
                    <div class="form-group px-1">
                        <input class="form-check-input categories" name="categories[]" type="checkbox" id="cate_{{$item->id}}" value="{{$item->id}}">
                        <label class="form-check-label" for="cate_{{$item->id}}">{{$item->name}}</label>
                    </div>
                @endforeach
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputFile">Hình Ảnh</label>
            <input type="file" class="form-control thumb" id="thumb" name="thumb">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Truyện Nổi Bật/HOT</label>
            <div class="form-check">
              <input class="form-check-input hot_book" type="radio" value="0" name="hot_book" checked>
              <label class="form-check-label">Truyện Mới</label>
            </div>
            <div class="form-check">
                <input class="form-check-input hot_book" type="radio" value="1" name="hot_book">
                <label class="form-check-label">Truyện Nổi Bật</label>
            </div>
            <div class="form-check">
                <input class="form-check-input hot_book" type="radio" value="2" name="hot_book">
                <label class="form-check-label">Truyện Xem Nhiều</label>
            </div>
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
        <button type="submit" class="btn btn-primary">Thêm Truyện</button>
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
        {{--$('body').on('submit', '#addNewBook', function (e) {--}}
        {{--   e.preventDefault();--}}
        {{--    const config = {--}}
        {{--        headers: {--}}
        {{--            'content-type': 'multipart/form-data'--}}
        {{--        }--}}
        {{--    }--}}
        {{--   let name = $('.name').val();--}}
        {{--   let author = $('.author').val();--}}
        {{--   let summary = $('.summary').val();--}}
        {{--   let description = $('.description').val();--}}
        {{--   let slug = $('.slug').val();--}}
        {{--   let hot_book = $('.hot_book').val();--}}
        {{--   let active = $('.active').val();--}}
        {{--   let categories = [];--}}
        {{--    $(':checkbox:checked').each(function(i){--}}
        {{--        categories[i] = $(this).val();--}}
        {{--    });--}}
        {{--    categories.pop();--}}
        {{--    categories.pop();--}}
        {{--    let thumb = "";--}}
        {{--    let file = $('.thumb')[0].files[0];--}}
        {{--    if (file){--}}
        {{--        thumb = file.name;--}}
        {{--    }--}}


        {{--    let FormData = {--}}
        {{--        name: name,--}}
        {{--        author: author,--}}
        {{--        summary: summary,--}}
        {{--        categories: categories,--}}
        {{--        thumb: thumb,--}}
        {{--        hot_book: hot_book,--}}
        {{--        slug: slug,--}}
        {{--        description: description,--}}
        {{--        active: active--}}
        {{--    }--}}

        {{--    axios.post("{{ route('book.store') }}", FormData).then(function (response) {--}}
        {{--        console.log(response.data);--}}
        {{--    }).catch(function (error) {--}}

        {{--    });--}}
        {{--});--}}
    </script>
@endsection
