<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Shunno | {{ ucfirst(explode('.', Route::currentRouteName())[0]) }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/uploads/favicon.png') }}" />
    <!-- Google Fonts -->
    <link href="{{ asset('backend') }}/assets/css/font.css" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/select2/bootstrap-5-theme.min.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/summernote/summernote-bs5.min.css">

    @stack('css')
</head>

<body>
    <!-- ======= Header ======= -->
    @include('backend.layouts.includes.header')
    <!-- ======= Sidebar ======= -->
    @include('backend.layouts.includes.sidebar')

    <!-- ======= Main Content ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ ucfirst(explode('.', Route::currentRouteName())[0]) }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">
                        {{ ucfirst(str_replace('.', ' > ', Route::currentRouteName())) }}</li>
                </ol>
            </nav>
        </div>
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    @include('backend.layouts.includes.footer')

    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    @include('sweetalert::alert')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('backend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/quill/quill.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/php-email-form/validate.js"></script>
    <!-- select2 js -->
    <script src="{{ asset('backend') }}/assets/js/select2/jquery.slim.min.js"></script>
    {{-- <script src="{{ asset('backend') }}/assets/js/select2/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('backend') }}/assets/js/summernote/summernote-bs5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/select2/select2.full.min.js"></script>
    <!-- main js -->
    <script src="{{ asset('backend') }}/assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.getElementById('loader-wrapper');
            window.addEventListener('load', function() {
                loader.style.display = 'none';
            });
        });
        $(".select2").select2();
    </script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>



    @stack('scripts')

</body>

</html>
