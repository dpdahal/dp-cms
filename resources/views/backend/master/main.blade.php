<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    <link href="{{url('dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

    <link href="{{url('dashboard/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/ckeditor/contents.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/css/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/css/cropper.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/css/style.css')}}" rel="stylesheet">
    <link href="{{url('dashboard/custom/custom.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(isset($title))
        <title>{{$title}}</title>
    @else
        <title>Document</title>
    @endif
</head>
<body>
@include('backend.layouts.top-header')
@include('backend.layouts.aside')
@yield('top-header')
@yield('aside')
@yield('content')

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>

            </span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Developed By <a href="">Dp dahal</a>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script src="{{url('dashboard/js/jquery.js')}}"></script>
<script src="{{url('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('dashboard/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{url('dashboard/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('dashboard/js/main.js')}}"></script>
<script src="{{url('dashboard/js/axios.js')}}"></script>
<script src="{{url('dashboard/js/dropzone.min.js')}}"></script>
<script src="{{url('dashboard/js/cropper.js')}}"></script>
<script src="{{url('dashboard/custom/sweetalert.js')}}"></script>
<script src="{{url('dashboard/custom/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    let ckeditorUploadUrl = "{{route('ckeditor-image-upload', ['_token' => csrf_token() ])}}";
</script>
@yield('scripts')

</body>
</html>