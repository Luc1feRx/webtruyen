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

    <script src="{{ asset('template/js/main.js') }}"></script>
    <script src="{{ asset('template/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('template/js/Jquery.js') }}" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('template/dist/owl.carousel.js') }}" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    <script type="text/javascript">
        $('#keywords').keyup(function(){
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
</body>
</html>
