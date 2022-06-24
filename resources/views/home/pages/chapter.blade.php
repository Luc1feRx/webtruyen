@extends('home.master')

  @section('nav')
  @include('home.pages.nav')
@endsection

  @section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
        @foreach ($cateb->book_in_multiple_cate as $itemssss)
            <li class="breadcrumb-item"><a href="{{ route('danh-muc', ['slug' => $itemssss->slug]) }}">{{$itemssss->name}}</a></li>
        @endforeach
        <li class="breadcrumb-item"><a href="{{ route('doc-truyen', ['slug' => $cateb->slug]) }}">{{$cateb->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
  </nav>

  <div class="row">
          <div class="row">
                <h1>{{$chapter->books->name}}</h1>
                <div class="row">
                    <p class="text-lg-start fs-3">{{$chapter->name}}</p>
                    <p class="text-lg-start fs-4">Chọn Chương</p>
                    <select class="form-select select-chapter" aria-label="Default select example">
                        @foreach ($getAllChapters as $chap)
                          <option value="{{ route('chapter', ['slug'=>$chap->slug]) }}">{{$chap->name}}</option>
                        @endforeach
                      </select>
                </div>
          </div>


          <div class="row py-lg-5">
            <div class="col-lg-4 col-md-8 mx-auto">
              <p style="text-align: center;">
                @if ($preChapter != null)
                <a href="{{ route('chapter', ['slug'=>$preChapter]) }}" class="btn btn-primary my-2">Chương Trước</a>
                @endif

                @if ($nextChapter != null)
                    <a href="{{ route('chapter', ['slug'=>$nextChapter]) }}" class="btn btn-primary my-2">Chương Sau</a>
                @endif
              </p>
            </div>
          </div>

            <div class="row mt-3">
                {!! $chapter->content !!}
            </div>

            <div class="row">
                <select class="form-select select-chapter" aria-label="Default select example">
                    @foreach ($getAllChapters as $chap)
                    <option value="{{ route('chapter', ['slug'=>$chap->slug]) }}">{{$chap->name}}</option>
                    @endforeach
                </select>
          </div>
          <div class="row py-lg-5">
            <div class="col-lg-4 col-md-8 mx-auto">
              <p style="text-align: center;">
                <p style="text-align: center;">
                    @if ($preChapter != null)
                    <a href="{{ route('chapter', ['slug'=>$preChapter]) }}" class="btn btn-primary my-2">Chương Trước</a>
                    @endif

                    @if ($nextChapter != null)
                        <a href="{{ route('chapter', ['slug'=>$nextChapter]) }}" class="btn btn-primary my-2">Chương Sau</a>
                    @endif
                  </p>
              </p>
            </div>
          </div>

  </div>


  @endsection

  {{-- @section('slide')
      @include('home.pages.slide')
  @endsection --}}
