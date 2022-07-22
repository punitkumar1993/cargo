<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        @include('frontend.magz.inc._head')
	</head>

	<body class="skin-orange">
        <!-- Header -->
		<header class="primary">
            @include('frontend.magz.template-parts.header')
		</header>

        <!-- Content -->
        @yield('content')

		<!-- Start footer -->
		<footer class="footer">
            @include('frontend.magz.template-parts.footer')
		</footer>
		<!-- End Footer -->

		<!-- JS -->
        @include('frontend.magz.inc._scripts')
	</body>
</html>
