@extends('layouts.app', ['page_title' => 'Dashboard'])
@section('content')
<div class="main-wrapper container">
  @include('layouts.header')
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div id="swagger-ui"></div>
    </section>
  </div>
</div>
@endsection

@section('page-css')
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Code+Pro:300,600|Titillium+Web:400,600,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}" >
<link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32" />
<link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16" />
<style>
  html
  {
      box-sizing: border-box;
      overflow: -moz-scrollbars-vertical;
      overflow-y: scroll;
  }
  *,
  *:before,
  *:after
  {
      box-sizing: inherit;
  }

  body {
    margin:0;
    background: #fafafa;
  }
</style>
@endsection

@section('page-js')
<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"> </script>
<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"> </script>
<script>
window.onload = function() {
  // Build a system
  const ui = SwaggerUIBundle({
    dom_id: '#swagger-ui',

    url: "{!! $urlToDocs !!}",
    operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
    configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
    validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
    oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback') }}",

    requestInterceptor: function(request) {
      request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
      return request;
    },

    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],

    plugins: [
      SwaggerUIBundle.plugins.DownloadUrl
    ],

    layout: "BaseLayout"
  })

  window.ui = ui
}
</script>
@endsection