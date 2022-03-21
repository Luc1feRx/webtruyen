<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TruyenHay</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang Chủ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Danh Mục Truyện
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('danh-muc', ['slug'=>Str::slug($category->name)]) }}">{{$category->name}}</a></li>
                @endforeach
            </ul>
          </li>

        </ul>

        <ul class="navbar-nav me-auto mb-lg-0" style="margin-right: 0!important;">
            <li class="nav-item">
                <select class="form-control me-2" id="switch_color">
                    <option value="white">Light</option>
                    <option value="black">Dark</option>
                  </select>
            </li>

            <li class="nav-item">
                <form autocomplete="off" class="d-flex" method="get" action="{{ route('search') }}">
                    {{ csrf_field() }}
                  <input class="form-control me-2" type="search" id="keywords" placeholder="Tìm Kiếm Tác Giả, Truyện" name="keyword" aria-label="Search">
                  <div class="dropdown search-ajax"></div>
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li>

    </ul>
      </div>
    </div>
  </nav>
