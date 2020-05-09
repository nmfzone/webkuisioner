@extends('layouts.app')

@push('stylesheets')

@endpush

@section('content-lv2')
  <header class="header">
    <nav class="navbar sm:px-8 lg:px-16 xl:px-40">
      <div class="navbar-brand">
        <a class="block" href="{{ route('index') }}">
          {{ config('app.name') }}
        </a>
      </div>

      <div class="block sm:hidden">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
        </button>
      </div>

      <div class="hidden sm:flex content-end">
        <ul class="menu flex flex-row items-center">
          <navbar-menu-item has-dropdown>
            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ auth()->user()->name }} <span class="fa fa-caret-down"></span>
            </a>

            <template v-slot:dropdown>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="POST">
                @csrf
              </form>
            </template>
          </navbar-menu-item>
        </ul>
      </div>
    </nav>
  </header>

  <div class="px-4 sm:px-8 lg:px-16 xl:px-40 py-8 flex flex-wrap bg-gray-150 min-h-screen">
    <main class="main">
      @yield('content-lv3')
    </main>
  </div>
@endsection
