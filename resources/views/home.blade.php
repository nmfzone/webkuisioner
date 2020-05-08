@extends('layouts.app')

@section('content-lv2')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!

          <a class="dropdown-item rounded bg-red-500 px-2 py-1 text-white text-xs" href="{{ route('logout') }}"
             title="Keluar dari situs ini"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            {{ __('Keluar') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
