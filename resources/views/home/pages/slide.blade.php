
<h3 class="mt-3">Truyện Hot</h3>
<div class="owl-carousel owl-theme mt-4">
    @foreach ($slides as $slide)
<div class="item">
    <a href="{{ route('doc-truyen', ['slug'=>$slide->slug]) }}">
        <img src="{{$slide->thumb}}" lazysrc="" alt="Cô dâu bị đánh tráo của tổng tài" class="img-responsive item-img">
        <div class="title">
            <h3>{{$slide->name}}</h3>
            <p><i class="fa-solid fa-eye"></i> {{$slide->views}}</p>
        </div>
    </a>
</div>
@endforeach
</div>
