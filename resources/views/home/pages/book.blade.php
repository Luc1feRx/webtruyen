@extends('home.master')

  @section('nav')
  @include('home.pages.nav')
@endsection

  @section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
        @foreach ($books->book_in_multiple_cate as $item)
        <li class="breadcrumb-item"><a href="{{ route('danh-muc', ['slug' => $item->slug]) }}">{{$item->name}}</a></li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
  </nav>

  <div class="row">
      <div class="col-md-9">
          <div class="row">
              <input type="hidden" value="{{$books->name}}" class="wishlist_title">
              <input type="hidden" value="{{URL::current()}}" class="wishlist_url">
              <input type="hidden" value="{{$books->id}}" class="wishlist_id">
              <input type="hidden" value="{{$books->views}}" class="wishlist_view">
                <div class="col-md-3">
                    <img class="card-img-top" width="100px" src="{{$books->thumb}}" alt="">
                </div>
                <div class="col-md-9">
                    <ul style="list-style: none;">
                        <li class="mt-1">Tên Truyện: {{$books->name}}</li>
                        <li class="mt-1">Tác Giả: {{$books->author}}</li>
                        <li class="mt-1">Thể Loại:
                            @foreach ($books->book_in_multiple_cate as $boo)
                                <span class="badge badge-primary"><a style="text-decoration: none;" href="{{ route('danh-muc', ['slug'=>$boo->slug]) }}">{{$boo->name}}</a></span>
                            @endforeach
                        </li>
                        <li class="mt-1">Ngày Đăng: {{$books->created_at->diffForHumans()}}</li>
                        <li class="mt-1">Cập Nhật Lúc: @if ($update_chapter != null)
                            {{$update_chapter->updated_at->diffForHumans()}}
                        @endif</li>
                        <li class="mt-1">Số Chapter: 32</li>
                        <li class="mt-1">Số Lượt Xem: {{$books->views}}</li>
                        <li class="mt-1"><a href="">Xem Muc Luc</a></li>
                        @if ($oneChapter && $lastChapter)
                                <li class="mt-1">
                                    <a href="{{ route('chapter', ['slug'=>$oneChapter->slug]) }}" class="btn btn-primary">Đọc Chương Đầu</a>
                                    <a href="{{ route('chapter', ['slug'=>$lastChapter->slug]) }}" class="btn btn-primary">Đọc Chương Mới Nhất</a>
                                </li>
                                <button type="button" class="btn btn-danger btn-thich-truyen mt-3"><i class="fa-solid fa-heart"></i> Truyện Yêu Thích</button>

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

              <style>
                  ul.list-chapter{
                      -moz-column-count: 3;
                      -moz-column-gap: 20px;
                      -webkit-column-count: 3;
                      -webkit-column-gap: 20px;
                      column-count: 3;
                      column-gap: 20px;
                  }
              </style>

              <div class="row">
                        <h4>Mục Lục</h4>
                        <ul class="list-chapter" style="list-style-type: disc;">
                            @php
                                $mucluc = count($chapters);
                            @endphp
                            @if ($mucluc != 0)
                            @foreach ($chapters as $chapter)
                                <li class="list-group-item mt-1"><a style="text-decoration: none; color: black;" href="{{ route('chapter', ['slug'=>$chapter->slug]) }}">{{$chapter->name}}</a></li>
                            @endforeach
                            @else
                                <div class="mt-2 card-title alert alert-danger">
                                    <p>Đang Cập Nhật</p>
                                </div>
                            @endif
                        </ul>

              </div>

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
        <h3 class="mt-3 fst-normal">Truyện Nổi Bật</h3>
            @foreach ($sidebarFeatureBooks as $sidebarFeatureBook)
            <div class="row mt-3">
                <div class="col-md-5"><img width="100%" class="img img-responsive card-img-top" src="{{$sidebarFeatureBook->thumb}}" alt="{{$sidebarFeatureBook->name}}"></div>
                <div class="col-md-7">
                    <a style="text-decoration: none;" href="{{ route('doc-truyen', ['slug'=>$sidebarFeatureBook->slug]) }}">
                        <p>Tên Truyện: {{$sidebarFeatureBook->name}}</p>
                        <p>Lượt Xem: {{$sidebarFeatureBook->views}}</p>
                    </a>
                </div>
            </div>
            @endforeach

        <h3 class="mt-3 fst-normal">Truyện Yêu Thích</h3>
        <div id="fav-books"></div>
    </div>
  </div>


  @endsection

  {{-- @section('slide')
      @include('home.pages.slide')
  @endsection --}}
