@extends('home.master')

@section('nav')
    @include('home.pages.nav')
@endsection

@section('content')
<style>

    .tags {
        font: 12px/1.5 'PT Sans', serif;
        /* margin: 25px; */
        list-style: none;
        margin: 0;
        overflow: hidden;
        padding: 0;
    }

    .tags li {
        float: left;
    }

    .tag {
        background: #000;
        border-radius: 3px 0 0 3px;
        color: #999;
        display: inline-block;
        height: 26px;
        line-height: 26px;
        padding: 0 20px 0 23px;
        position: relative;
        margin: 0 10px 10px 0;
        text-decoration: none;
        -webkit-transition: color 0.2s;
    }

    .tag::before {
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        content: '';
        height: 6px;
        left: 10px;
        position: absolute;
        width: 6px;
        top: 10px;
    }

    .tag::after {
        background: #fff;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #eee;
        border-top: 13px solid transparent;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
    }

    .tag:hover {
        background-color: crimson;
        color: white;
    }

    .tag:hover::after {
        border-left-color: crimson;
    }

</style>




  <ul class="nav nav-tabs" id="myTab" role="tablist">
      @php
          $i = 0;

      @endphp
    @foreach ($categories as $tab_category)
    @php
        $i++;
    @endphp
    <form>
        {{ csrf_field() }}

    <li class="nav-item" role="presentation">
        <form action="">
            <a data-category_id="{{$tab_category->id}}" class="nav-link tabs_category {{$i == 0 ? 'active' : ''}}" id="home-tab" data-bs-toggle="tab" href="#{{$tab_category->slug}}" name="tab_category[]" role="tab" aria-controls="home" aria-selected="true">{{$tab_category->name}}</a>
        </form>
    </li>
    </form>
    @endforeach
  </ul>

  <div class="album py-5 bg-light tab-content" >
    <div id="tab_category" class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">

    </div>
</div>



<!---- new book -->
            <h3 class="mt-3">Truyện Mới Cập Nhật</h3>
            <div class="album py-5 bg-light">
                <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">
                    @foreach ($books as $book)
                    <div class="col">
                      <div class="card shadow-sm">
                          <a href="{{ route('doc-truyen', ['slug'=>$book->slug]) }}"><img class="card-img-top" width="80px" src="{{$book->thumb}}" alt=""></a>

                        <div class="card-body">
                            <h5>{{$book->name}}</h5>
                          <div class="card-text">
                            <ul class="tags">
                                @foreach ($book->book_in_multiple_cate as $cates)
                                    <li><a href="{{ route('danh-muc', ['slug' => $cates->slug]) }}" class="tag">{{$cates->name}}</a></li>
                                @endforeach
                            </ul>
                          </div>
                          <div style="width: 100%;" class="mt-2 d-flex justify-content-between">
                            <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i> {{$book->views}}</a>
                            <a href="{{ route('doc-truyen', ['slug'=>$book->slug]) }}" class="btn btn-sm btn-outline-secondary">Đọc Ngay</a>
                            <small class="mp-2 d-flex justify-content-center text-muted">Cập Nhật: {{$book->updated_at->diffForHumans()}}</small>
                          </div>
                        </div>
                      </div>

                    </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- Filter books -->
            <h3 class="mt-3">Lọc Truyện Từ A-Z</h3>
            <div class="album py-5 bg-light">
                    @foreach (range('A', 'Z') as $char)
                    <a href="{{ route('filteredChar', ['char'=>$char]) }}" class="btn btn-success" style="text-decoration: none; color: #fff">{{$char}}</a>
                    @endforeach
            </div>

@endsection

@section('slide')
    @include('home.pages.slide')
@endsection


