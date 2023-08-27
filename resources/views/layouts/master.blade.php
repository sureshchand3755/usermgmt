<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard">
	<meta name="author" content="Soeng Souy">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Soeng Souy : Admin Template">
	<meta property="og:title" content="Soeng Souy : Admin Template">
	<meta property="og:description" content="Soeng Souy:Admin Template">
	<meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	<!-- PAGE TITLE HERE -->
	<title> Home Page</title>
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{URL::to('assets/images/favicon.png')}}">
	<link href="{{URL::to('assets/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{URL::to('assets/vendor/nouislider/nouislider.min.css')}}">
	<!-- Datatable -->
	<link href="{{URL::to('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="{{URL::to('assets/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<!-- Style css -->
    <link href="{{URL::to('assets/css/style.css')}}" rel="stylesheet">

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

</head>
<body>

    <!-- Preloader start -->
    <div id="preloader">
        <div class="waviy">
		   <span style="--i:1">L</span>
		   <span style="--i:2">o</span>
		   <span style="--i:3">a</span>
		   <span style="--i:4">d</span>
		   <span style="--i:5">i</span>
		   <span style="--i:6">n</span>
		   <span style="--i:7">g</span>
		   <span style="--i:8">.</span>
		   <span style="--i:9">.</span>
		   <span style="--i:10">.</span>
		</div>
    </div>
    <!-- Preloader end -->


    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- Nav header start -->
        <div class="nav-header">
            <a href="{{ route('user/list') }}" class="brand-logo">
				<h1>Admin</h1>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

		<!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Users
                            </div>
                        </div>

                    </div>
				</nav>
			</div>
		</div>
        <!-- Header end ti-comment-alt -->

        <!-- Sidebar start -->
       	@include('sidebar.sidebar')
		<!-- Sidebar end -->

		<!-- Content body start -->
        @yield('content')
        <!-- Content body end -->

	</div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="{{URL::to('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{URL::to('assets/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{URL::to('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
	<!-- Apex Chart -->

	<!-- Datatable -->
	<script src="{{URL::to('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::to('assets/js/plugins-init/datatables.init.js')}}"></script>

	<script src="{{URL::to('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	{{-- <script src="{{URL::to('assets/vendor/apexchart/apexchart.js')}}"></script> --}}
	{{-- <script src="{{URL::to('assets/vendor/nouislider/nouislider.min.js')}}"></script> --}}
	<script src="{{URL::to('assets/vendor/wnumb/wNumb.js')}}"></script>
	<!-- Dashboard 1 -->
	{{-- <script src="{{URL::to('assets/js/dashboard/dashboard-1.js')}}"></script> --}}
    <script src="{{URL::to('assets/js/custom.min.js')}}"></script>
	<script src="{{URL::to('assets/js/dlabnav-init.js')}}"></script>
	{{-- <script src="{{URL::to('assets/js/demo.js')}}"></script> --}}
    {{-- <script src="{{URL::to('assets/js/styleSwitcher.js')}}"></script> --}}
    <!-- jQuery validation plugin -->
	@yield('script')

</body>
</html>
