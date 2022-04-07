@extends('home.master')

@section('nav')
    @include('home.pages.nav')
@endsection

@section('content')
              <!-- Filter books -->
            <h3 class="mt-3">Lọc Truyện Từ A-Z</h3>
            @php
            $bookss = count($books);
            @endphp
            <div class="album py-5 bg-light">
                <div class="container">
                    @foreach (range('A', 'Z') as $char)
                    <a href="{{ route('filteredChar', ['char'=>$char]) }}" class="btn btn-success" style="text-decoration: none; color: #fff">{{$char}}</a>
                    @endforeach
                    @if ($bookss)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5" style="overflow: hidden; margin-top: 20px;">
                            @foreach ($books as $book_fillter)
                                <div class="item-fillter" itemscope="">
                                    <a href="{{ route('doc-truyen', ['slug'=>$book_fillter->slug]) }}" itemprop="url">
                                        <span class="full-label"></span>
                                        <img src="{{$book_fillter->thumb}}" style="height: 192px; width: 129px;" alt="{{$book_fillter->name}}" class="img-responsive item-img" itemprop="image">
                                        <div class="title">
                                            <h3 itemprop="name">{{$book_fillter->name}}</h3>
                                            <h3 itemprop="view"><i class="fa-solid fa-eye"></i> {{$book_fillter->views}}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-2 card-title alert alert-danger">
                            <p>Không Tìm Thấy Truyện</p>
                        </div>
                    @endif
                </div>
            </div>


@endsection

@section('slide')
    @include('home.pages.slide')
@endsection

