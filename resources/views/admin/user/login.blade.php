<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{ asset('template/admin/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('template/admin/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('login-admin') }}" method="post">
                    @include('admin.error.error')
					<span class="login100-form-title p-b-34">
						Admin Login
					</span>
						{{ csrf_field() }}
                        <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type email">
                            <input id="first-name" class="input100" type="email" name="admin_email" placeholder="Email">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                            <input class="input100" type="password" name="admin_password" placeholder="Password">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button type="submit" name="login" class="login100-form-btn">
                                Sign in
                            </button>
                        </div>
					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="#" class="txt3">
							Sign Up
						</a>
					</div>
				</form>
                @php
                    $link = asset('template/admin/images/bg-01.jpg');
                @endphp
				<div class="login100-more" style="background-image: url('{{$link}}');"></div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{ asset('template/admin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('template/admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/vendor/select2/select2.min.js') }}"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('template/admin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/admin/js/main.js') }}"></script>
</body>
</html>
