<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">

  <!-- CSRF-TOKEN -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title','') &mdash; {{ config('app.name') }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  <!-- CSS Libraries -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/css/load.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom-image.css') }}">
  @stack('css_internal')
  @stack('css_external')
</head>

<body>
    <!-- Loader Start -->
    <div id="preloader">
        <div id="status">
            <div class="sk-chase mt-4">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Loader End -->
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts.header')
      <div class="main-sidebar">
        @include('layouts.menu')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
  <script type="text/javascript">
    var tokenCSRF = jQuery('meta[name="csrf-token"]').attr('content');
    var url_link = "{{ asset('/') }}";
    $(document).ready(function() {
        $('#preloader').show();
    });

    function out_load() {
        $('#preloader').hide();
    }

    function in_load() {
        $('#preloader').show();
    }

    function error_detail(error) {
        console.log(error);
        if(error.responseJSON.status == 'warning') {
            swal('Warning', ''+error.responseJSON.messages+'', 'warning');
            return false;
        } else if(error.responseJSON.status == 'error') {
            swal('Error', ''+error.responseJSON.messages+'', 'error');
            return false;
        } else {
            swal(''+error.status+'', ''+error.responseJSON.messages+'', 'error');
            return false;
        }
    }
  </script>

  <!-- JS Libraies -->
  @stack('js_internal')
  @stack('js_external')
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  @yield('custom_js','')
  <script type="text/javascript">
    setInterval(function() {
        $('#preloader').hide();
    }, 500);
  </script>
</body>
</html>
