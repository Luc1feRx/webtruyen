@extends('home.master')

  @section('nav')
  @include('home.pages.nav')
@endsection

  @section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('danh-muc', ['slug' => $books->categories->slug]) }}">{{$books->categories->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
  </nav>

  <div class="row">
      <div class="col-md-9">
          <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top" width="100px" src="{{$books->thumb}}" alt="">
                </div>
                <div class="col-md-9">
                    <ul style="list-style: none;">
                        <li class="mt-1">Tên Truyện: {{$books->name}}</li>
                        <li class="mt-1">Tác Giả: {{$books->author}}</li>
                        <li class="mt-1">Thể Loại: <a style="text-decoration: none;" href="{{ route('danh-muc', ['slug'=>$books->categories->slug]) }}">{{$books->categories->name}}</a></li>
                        <li class="mt-1">Ngày Đăng: {{$books->created_at->diffForHumans()}}</li>
                        <li class="mt-1">Cập Nhật Lúc: {{$books->updated_at->diffForHumans()}}</li>
                        <li class="mt-1">Số Chapter: 32</li>
                        <li class="mt-1">Số Lượt Xem: 42525</li>
                        <li class="mt-1"><a href="">Xem Muc Luc</a></li>
                        @if ($oneChapter && $lastChapter)
                                <li class="mt-1">
                                    <a href="{{ route('chapter', ['slug'=>$oneChapter->slug]) }}" class="btn btn-primary">Đọc Chương Đầu</a>
                                    <a href="{{ route('chapter', ['slug'=>$lastChapter->slug]) }}" class="btn btn-primary">Đọc Chương Mới Nhất</a>
                                </li>

                        @else
                            <div class="mt-2 card-title alert alert-danger">
                                <p>Đang Cập Nhật</p>
                            </div>
                        @endif
                    </ul>
                </div>

                <div class="col-md-12 mt-3">
                    {!! $books->description !!}
                </div>

              <hr>
              <hr>

                <h4>Mục Lục</h4>
                <ul style="list-style: none;">
                    @php
                        $mucluc = count($chapters);
                    @endphp
                    @if ($mucluc != 0)
                        <ul class="list-group">
                        @foreach ($chapters as $chapter)
                            <li class="list-group-item mt-1"><a style="text-decoration: none; color: black;" href="{{ route('chapter', ['slug'=>$chapter->slug]) }}">{{$chapter->name}}</a></li>
                        @endforeach
                        </ul>
                    @else
                        <div class="mt-2 card-title alert alert-danger">
                            <p>Đang Cập Nhật</p>
                        </div>
                    @endif
              </ul>

              <div class="fb-comments" data-href="http://localhost:85/webtruyen/public/toan-chuc-phap-su-chi-mac-thien.html" data-width="" data-numposts="10"></div>


              <div class="album py-5 bg-light">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">
                    @foreach ($sameCate as $same)
                    <div class="col">
                      <div class="card shadow-sm">
                          <a href="{{ route('doc-truyen', ['slug'=>$same->slug]) }}"><img class="card-img-top" width="80px" src="{{$same->thumb}}" alt=""></a>

                        <div class="card-body">
                            <h5>{{$same->name}}</h5>
                          <div class="card-text">{{ $same->summary }}</div>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group mt-2">
                              <a href="{{ route('doc-truyen', ['slug'=>$same->slug]) }}" class="btn btn-sm btn-outline-secondary">Đọc Ngay</a>
                              <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i> 20333</a>
                            </div>
                            <small class="text-muted">9 mins ago</small>
                          </div>
                        </div>
                      </div>

                    </div>
                    @endforeach
                  </div>
                  <a href="" class="btn btn-success mt-3">Xem Tất Cả</a>
              </div>
          </div>
      </div>
      <div class="col-md-3">
        <h3>Sách HOT</h3>
    </div>
  </div>


  @endsection

  {{-- @section('slide')
      @include('home.pages.slide')
  @endsection --}}
