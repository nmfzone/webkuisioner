@extends('layouts.app')

@section('content-lv2')
  <div class="bg-gray-100 bg-cover bg-scroll sm:px-8 lg:px-16 xl:px-40 container-full">
    <div class="w-full bg-white md:w-1/2 rounded-lg border-t-4 border-blue-800 shadow-md py-8 px-6 md:mx-auto mx-5">
      <div class="text-xl md:text-3xl font-bold text-center font-normal">{{ __('Verify Your Email Address') }}</div>

      <div class="mt-6">
        @if (session('resent'))
          <alert state="success" message="{{ __('A fresh verification link has been sent to your email address.') }}" dismissible></alert>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email, press button below.') }}
        <form class="mt-4" method="POST" action="{{ route('verification.resend') }}">
          @csrf
          <button type="submit" class="btn">
            {{ __('Resent Verification Email') }}
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
