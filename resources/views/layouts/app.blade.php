<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('meta')

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ asset_url('css/app.css') }}" rel="stylesheet">

  @stack('stylesheets')
</head>
<body>
  <div id="app">
    @yield('content')
  </div>

  <script type='text/javascript'>
    window.App = {!! json_encode([
      'csrfToken' => csrf_token(),
      'appDomain' => app_main_domain(),
    ]) !!}
  </script>

  <script src="{{ asset_url('js/app.js') }}"></script>

  @stack('javascripts')
</body>
</html>
