@extends('layouts.dashboard')

@section('content-lv3')
  <div>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    You are logged in!
  </div>
@endsection
