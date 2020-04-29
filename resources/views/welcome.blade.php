@extends('layouts.app')

@section('content')
  @auth
    Nama: {{ auth()->user()->name }}

    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  @else
    <social-login></social-login>
  @endauth
@endsection
