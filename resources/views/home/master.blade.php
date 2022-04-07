<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('template/dist/assets/owl.carousel.css') }}" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('template/dist/assets/owl.theme.default.min.css') }}" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('template/css/sweetalert.css') }}">
</head>
<body>

    <style>
        .switch_colors{
            background: #181818;
            color: white;
        }

        .switch_album_text_light {
            background: #181818 !important;
            color: black;
        }

        .item{
            height: 240px;
            width: 160px;
            position: relative;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out;
        }

        .item-fillter{
            float: left;
            margin: 12px 0 0 12px;
            height: 192px;
            width: 129px;
            position: relative;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out;
        }

        .title{
            position: absolute;
            bottom: 0;
            width: 100%;
            color: #f4f4f4;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 5px 0;
            text-shadow: 1px 2px 2px #000;
            font-size: 12px;
            display: block;
            margin-top: 2px;
            text-align: center;
            font-family: 'Roboto Condensed',Tahoma,sans-serif;
        }

        .title h3{
            margin: 0;
            padding: 0;
            font-size: inherit;
            display: inline-block;
        }

    </style>


    <div class="container">
        <!---- menu -->
        @yield('nav')

        <!---- slider -->
        @yield('slide')

          <!---- content -->
          @yield('content')

          @include('home.footer')
    </div>


    <!-- slider js -->
    <script src="{{ asset('template/js/main.js') }}"></script>
    <script src="{{ asset('template/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('template/js/Jquery.js') }}" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('template/dist/owl.carousel.js') }}" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('template/js/sweetalert.js') }}"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            dot:true,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>

    <!-- Tabs Category -->
    <script type="text/javascript">
        $('.tabs_category').click(function(){
            let id = $(this).data('category_id');
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('tabCate') }}",
                method: 'POST',
                data: {id: id, _token:_token},
                success: function(data){
                    $('#tab_category').html(data);
                }
            });
        });
    </script>
    <!-- select chapter -->
    <script type="text/javascript">
        $('.select-chapter').on('change', function(){
            var url = $(this).val();
            if(url){
                window.location = url;
            }
            return false;
        });

        currentChapter();

        function currentChapter() {
            var url = window.location.href;
            $('.select-chapter').find('option[value="' + url + '"]').attr('selected', true);
        }
    </script>

    <!-- search by using ajax -->
    <script type="text/javascript">
        $('#keywords').on('keyup',function(){
            var keywords = $(this).val();
            if(keywords != ''){
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('search-ajax') }}",
                    method: 'POST',
                    data:{keywords:keywords, _token:_token},
                    success: function(data){
                        $('.search-ajax').fadeIn();
                        $('.search-ajax').html(data);
                    }

                })
            }else{
                $('.search-ajax').fadeOut();
            }
        });

        $(document).on('click', 'dropdown-item', function(){
            $('#keywords').val($(this).text());
            $('.search-ajax').fadeOut();
        });
    </script>

    <!-- theme -->
    <script type="text/javascript">
        $(document).ready(function(){

            const data = localStorage.getItem('switch_color');

            if(data != null){

                const data_obj = JSON.parse(data);
                $(document.body).addClass(data_obj.class_1);
                $('.album').addClass(data_obj.class_2);

                $("select option[value='black']").attr('selected', 'selected');
            }


            $('#switch_color').change(function(){

                $(document.body).toggleClass('switch_colors');
                $('.album').toggleClass('switch_album_text_light');
                var color = $(this).val();

                if(color == 'black'){
                    var items = {
                        'class_1':'switch_colors',
                        'class_2':'switch_album_text_light'
                    };

                    localStorage.setItem('switch_color', JSON.stringify(items));
                }else if(color == 'white'){
                    localStorage.removeItem('switch_color', JSON.stringify(items));
                }
            });
        });
    </script>

    <!-- favorite books -->

    <script type="text/javascript">
        $(document).ready(function(){

            showFavoriteBook();

            function showFavoriteBook(){
                var favorite_books = localStorage.getItem('favorite_books');
                if(favorite_books != null){
                    var data = JSON.parse(favorite_books);

                    data.reverse();

                    for(var i=0; i<data.length; i++){
                        var title = data[i].name;
                        var id = data[i].id;
                        var url = data[i].url;
                        var img = data[i].img;
                        var view = data[i].view;

                        $('#fav-books').append(`<div class="row mt-3">
                                    <div class="col-md-5"><img width="100%" class="img img-responsive card-img-top" src="`+ img +`" alt="`+ title +`"></div>
                                    <div class="col-md-7">
                                        <a style="text-decoration: none; color:#fff;" href="`+ url +`">
                                            <p>`+ title +`</p>
                                            <p><i class="fa-solid fa-eye"></i> `+ view +`</p>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-remove mt-3" onclick="RemoveF(`+ id +`)"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>`);

                    }
                }else if(favorite_books == []){
                    $('#fav-books').append(`<div class="mt-2 card-title alert alert-danger">
                                <p>Đang Cập Nhật</p>
                            </div>`);
                }
            }


            $('.btn-thich-truyen').click(function(){

                $('.fa-heart').css('color', '#fac');
                var id = $('.wishlist_id').val();
                var img = $('.card-img-top').attr('src');
                var name = $('.wishlist_title').val();
                var url = $('.wishlist_url').val();
                var view = $('.wishlist_view').val();
                var items = {
                        'id':id,
                        'img':img,
                        'name':name,
                        'url':url,
                        'view':view
                    };

                if(localStorage.getItem('favorite_books')==null){
                    localStorage.setItem('favorite_books', '[]');
                }

                var old_data = JSON.parse(localStorage.getItem('favorite_books')); // lay nhung truyen da thich
                var matches = $.grep(old_data, function(obj){
                    return obj.id == id;
                });

                if(matches.length) {
                    alert('Bạn Đã Thêm Truyện Này Rồi!');
                }else{
                    if(old_data.length <= 5){
                        old_data.push(items);
                    }else{
                        alert('Truyện Yêu Thích Của Bạn Đã Giới Hạn!');
                    }

                    $('#fav-books').append(`<div class="row mt-3">
                                    <div class="col-md-5"><img width="100%" class="img img-responsive card-img-top" src="`+ img +`" alt="`+ name +`"></div>
                                    <div class="col-md-7">
                                        <a style="text-decoration: none; color:#fff;" href="`+ url +`">
                                            <p>`+ name +`</p>
                                            <p><i class="fa-solid fa-eye"></i> `+ view +`</p>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-remove mt-3" onclick="RemoveF(`+ id +`)"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>`);



                    localStorage.setItem('favorite_books', JSON.stringify(old_data));
                    var title = 'Thông Báo';
                    var text = 'Đã Lưu Vào Danh Sách Truyện Yêu Thích';
                    var icon = 'success';
                    var confirmButtonText = 'Oke';
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: confirmButtonText
                    });
                }

                localStorage.setItem('favorite_books', JSON.stringify(old_data));


            });
        });

        function RemoveF(id){
            var favorite_books = localStorage.getItem('favorite_books');
            var result = Swal.fire({
                    title: 'Thông Báo',
                    text: "Bạn Chắc Chứ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(favorite_books != null){
                                var data = JSON.parse(favorite_books);
                                data.reverse();

                                data.forEach(function(item, index){
                                    if(id == item.id){
                                        data.splice(index, 1);
                                        Swal.fire(
                                        'Deleted!',
                                        'Đã Xóa Thành Công',
                                        'success'
                                        );
                                        setTimeout(location.reload.bind(location), 1500);
                                    }
                                });
                                localStorage.setItem('favorite_books', JSON.stringify(data));
                            }
                        }
                    });

        }

    </script>


</body>
</html>
