<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $page_title }} &mdash; Boojbook</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  @yield('page-css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
</head>

<body class="layout-3">
  <div id="app">
    @yield('content')
  </div>
  @include('modals.api')
  <!-- General JS Scripts -->
  <script src="{{ url('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ url('assets/modules/popper.js') }}"></script>
  <script src="{{ url('assets/modules/tooltip.js') }}"></script>
  <script src="{{ url('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ url('assets/modules/moment.min.js') }}"></script>
  <script src="{{ url('assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  @yield('page-js')
  <script>
  $(document).ready(function () {
    $('#generate-token').click(function() {
      $.ajax({
        type: "GET",
        url: "{{ url('user/api') }}",
        dataType: "json",
        success: function (response) {
          if(response.response == 1){
            $('#apiModal').modal();
            $('#api-content').html('Your newly generated API token is :'+response.api_token+' please save this token, it will only be displayable right now.');
          }
        }
      });
    });
  });
  </script>
  <!-- Template JS File -->
  <script src="{{ url('assets/js/scripts.js') }}"></script>
  <script src="{{ url('assets/js/custom.js') }}"></script>
  <script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  </script>
</body>
</html>