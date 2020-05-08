@extends('layouts.base')

@push('stylesheets')
  <link href='https://fonts.googleapis.com/css2?family=Exo+2:wght@200;300;400;600' rel='stylesheet' type='text/css'>
@endpush

@section('content')
  <div class="w-full font-exo font-light">
    @yield('content-lv2')
  </div>
@endsection
