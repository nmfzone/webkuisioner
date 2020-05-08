@extends('layouts.app')

@section('content-lv2')
  <div class="bg-gray-100 bg-cover bg-scroll sm:px-8 lg:px-16 xl:px-40 container-full">
    <div class="w-full bg-white md:w-1/2 lg:w-1/3 rounded-lg border-t-4 border-blue-800 shadow-md py-8 px-6 md:mx-auto mx-5">
      <div class="text-xl md:text-3xl font-bold text-center font-normal">{{ __('Reset Password') }}</div>

      <div class="mt-6">
        @if (session('status'))
          <alert state="success" message="{{ session('status') }}" dismissible></alert>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="mt-1">
            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>

            <div class="form-stack">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <b>{{ $message }}</b>
                </span>
              @enderror
            </div>
          </div>

          <div class="mt-6">
            <div class="flex">
              <button type="submit" class="btn">
                {{ __('Send Password Reset Link') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
