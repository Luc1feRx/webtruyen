  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('template/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('template/admin/js/main.js') }}"></script>
<script src="{{ asset('template/admin/js/sweetalert.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('ckeditor')
<!-- Page specific script -->
@yield('footer')
<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.hot_books').change(function(e){
            e.preventDefault();
            var hot_books = $(this).val();
            var hot_book_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            if(hot_books == 0){
                var title = 'Thông Báo';
                var text = 'Thay Đổi Truyện Mới Thành Công';
                var icon = 'success';
                var confirmButtonText = 'Oke';
            }else if(hot_books == 1){
                var title = 'Thông Báo';
                var text = 'Thay Đổi Truyện Nổi Bật Thành Công';
                var icon = 'success';
                var confirmButtonText = 'Oke';
            }else if(hot_books == 2){
                var title = 'Thông Báo';
                var text = 'Thay Đổi Truyện Xem Nhiều Thành Công';
                var icon = 'success';
                var confirmButtonText = 'Oke';
            }
            $.ajax({
                url: "{{ route('featured-books') }}",
                method: 'POST',
                data:{hot_books:hot_books, hot_book_id:hot_book_id, _token: _token},
                    success: function(data){
                        Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: confirmButtonText
                        });
                    }
                });
        });
    });
</script>

<script type="text/javascript">
   function DeleteRow(id, url) {
       console.log(id);
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
                                  $.ajax({
                                    type: 'DELETE',
                                    datatype: 'JSON',
                                    data: {id},
                                    url: url,
                                    success: function(result){
                                      location.reload();
                                      console.log(url);
                                    }
                                });
                              }
                            }
                        );
                    }

</script>

  <script type="text/javascript">
      function payloads(token) {
          const Payload = token.split(".")[1]; //get payload
          return JSON.parse(atob(Payload));
      }
      //

      function isCheckToken(token) {
          const Payload = payloads(token);
          console.log(Payload.iss);
          if (Payload) {
              return (Payload.iss = !!("http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/register"));
          }
          return false;
      }

      function LoggedIn() {
          //get token from localstorage
          const token = localStorage.getItem('access_token');
          if(token){
              if(isCheckToken(token)){return true;} return false;
          }
          return false;
      }

      function DashBoard() {
          if(LoggedIn() == false){
              window.location = "{{route('get-login')}}";
          }
      }

      DashBoard();

  </script>

{{--  logout--}}
  <script type="text/javascript">
    $('body').on('submit', '#btnLogOut', function (e) {
        e.preventDefault();
        localStorage.removeItem('access_token');
        window.location = "{{route('get-login')}}";
    })
  </script>

