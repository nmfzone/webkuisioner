@extends('layouts.app')

@section('content-lv2')
  <div class="bg-gray-100 bg-cover bg-scroll sm:px-8 lg:px-16 xl:px-40 container-full">
    <div class="w-full bg-white md:w-1/2 lg:w-1/3 rounded-lg border-t-4 border-blue-800 shadow-md py-8 px-6 md:mx-auto mx-5">
      <div class="text-xl md:text-3xl font-bold text-center font-normal">{{ __('Confirm Password') }}</div>

      <div class="mt-6">
        <alert state="warning" message="{{ __('Please confirm your password before continuing.') }}"></alert>

        <form method="POST" action="{{ route('password.confirm') }}">
          @csrf

          <div class="mt-1">
            <label for="password" class="form-label">{{ __('Password') }}</label>

            <div class="form-stack">
              <form-input id="password" type="password" @error('password') :state="false" @enderror name="password" autocomplete="current-password" with-add-on required></form-input>

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <b>{{ $message }}</b>
                </span>
              @enderror
            </div>
          </div>

          <div class="mt-6">
            <div class="flex">
              <button type="submit" class="btn">
                {{ __('Confirm Password') }}
              </button>

              @if (Route::has('password.request'))
                <a class="btn bg-white text-black hover:text-blue-500 hover:bg-white" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
