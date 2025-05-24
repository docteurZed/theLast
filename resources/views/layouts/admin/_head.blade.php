<!-- Meta Data -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ env('APP_NAME') }}</title>

<!-- Favicon -->
{{-- <link rel="icon" href="../assets/images/brand-logos/favicon.ico" type="image/x-icon"> --}}

<!-- Choices JS -->
{{-- <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script> --}}

<!-- Main Theme Js -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Bootstrap Css -->
<link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" >

<!-- Style Css -->
<link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" >

<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" >

<!-- Node Waves Css -->
{{-- <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet" > --}}

<!-- Simplebar Css -->
<link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet" >

{{-- <!-- Color Picker Css -->
<link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}"> --}}

<!-- Choices Css -->
<link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}"> --}}

<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}"> --}}

<!-- Full Calendar CSS -->
{{-- <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/main.min.css') }}"> --}}

<!-- Sweetalerts CSS -->
<link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">

<!-- Prism CSS -->
{{-- <link rel="stylesheet" href="{{ asset('assets/libs/prismjs/themes/prism-coy.min.css') }}"> --}}

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"> --}}

<link href="{{ asset('summernote/summernote.min.css') }}" rel="stylesheet">
