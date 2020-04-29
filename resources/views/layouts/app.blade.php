<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    @yield('content')
  </div>

  <script type='text/javascript'>
    window.App = {!! json_encode([
      'csrfToken' => csrf_token(),
      'appDomain' => env('APP_DOMAIN')
    ]) !!}
  </script>

  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
