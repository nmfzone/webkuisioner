@extends('layouts.dashboard')

@section('content-lv3')
  <div class="simple-card">
    <div class="header">
      Menu
    </div>
    <div class="body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      You are logged in!
    </div>
  </div>
@endsection
