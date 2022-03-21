@extends('home.master')

@section('nav')
    @include('home.pages.nav')
@endsection

@section('content')
            <h3 class="mt-3">{{$title}}</h3>
            @php
            $count = count($books);
            @endphp
            @if ($count != 0)
            <div class="album py-5 bg-light">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">
                    @foreach ($books as $book)
                    <div class="col">
                      <div class="card shadow-sm">
                          <a href="{{ route('doc-truyen', ['slug'=>$book->slug]) }}"><img class="card-img-top" width="80px" src="{{$book->thumb}}" alt=""></a>

                        <div class="card-body">
                            <h5>{{$book->name}}</h5>
                          <div class="card-text">{{ $book->summary }}</div>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group mt-2">
                              <a href="{{ route('doc-truyen', ['slug'=>$book->slug]) }}" class="btn btn-sm btn-outline-secondary">Đọc Ngay</a>
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
                    @else
                        <div class="card-title alert alert-danger">
                            <p>Không Tìm Thấy Truyện</p>
                        </div>

                    @endif

@endsection

@section('slide')
    @include('home.pages.slide')
@endsection


