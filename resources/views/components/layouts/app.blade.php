<html class="no-js" lang="zxx" dir="ltr">
    @include('components.layouts.partials.head')

    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">
                You are using an <strong>outdated</strong> browser. Please
                <a href="https://browsehappy.com/">upgrade your browser</a> to
                improve your experience and security.
            </p>
        <![endif]-->

        <!--********************************
   		Code Start From Here
	******************************** -->

        <!--==============================
    Sidemenu
============================== -->
        @include('components.layouts.partials.header') @yield('content')

        <!--==============================
    @include('components.layouts.partials.footer')


    <!-- Jquery -->
        <script src="{{
                asset('assets/js/vendor/jquery-3.7.1.min.js')
            }}"></script>
        <!-- Swiper Js -->
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- Magnific Popup -->
        <script src="{{
                asset('assets/js/jquery.magnific-popup.min.js')
            }}"></script>
        <!-- Counter Up -->
        <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <!-- Range Slider -->
        <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
        <!-- Isotope Filter -->
        <script src="{{
                asset('assets/js/imagesloaded.pkgd.min.js')
            }}"></script>
        <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>

        <!-- Main Js File -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        @livewireScripts
    </body>
</html>
