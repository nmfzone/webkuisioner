@extends('layouts.web')

@section('content-lv2')
  <div class="font-light">
    <div class="w-full mb-6">
      <h3 class="text-2xl md:text-3xl mb-5 text-center">
        Selamat Datang di {{ $site->title }}
      </h3>

      <div class="welcome-message fine-justify">
        {!! $site->welcome_message !!}
      </div>
    </div>

    @auth
      <div class="w-full fine-justify mb-4">
        <p class="mb-1">
          Selamat Datang, <b>{{ auth()->user()->name }}</b>.

          <a class="dropdown-item rounded bg-red-500 px-2 py-1 text-white text-xs" href="{{ route('logout') }}"
             title="Keluar dari situs ini"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Keluar') }}
          </a>
        </p>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        <p>Jika Anda ingin mengikuti kegiatan ini, silahkan tekan tombol di bawah ini:</p>

        <div class="text-center my-5">
          <a class="dropdown-item rounded bg-blue-600 px-4 py-2 text-white text-lg"
             href="{{ tenant_route('register.participant') }}"
             title="Daftar sebagai partisipan"
             onclick="event.preventDefault();
             document.getElementById('next-form').submit();">
            {{ __('Lanjutkan') }} <i class="fa fa-arrow-right"></i>
          </a>

          <form id="next-form" action="{{ tenant_route('register.participant') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    @else
      <div class="w-full fine-justify">
        Jika Anda ingin mengikuti kegiatan ini, silahkan melakukan pendaftaran menggunakan salah satu akun
        sosial media Anda.
      </div>
      <div class="w-5/6 mx-auto my-5">
        <social-login></social-login>
      </div>
    @endauth

    <div class="w-full">
      <p class="fine-justify">
        Dengan @auth menekan tombol di atas, @else melakukan pendaftaran, @endauth berarti Anda telah setuju
        dengan syarat & ketentuan yang berlaku pada situs ini <span class="text-green-800 font-bold">{!! request()->getSchemeAndHttpHost() !!}</span>.
      </p>

      <hr class="my-2"/>

      <a href="{{ tenant_route('privacy_policy') }}" target="_blank" class="text-xl text-blue-700 font-normal">
        Syarat & Ketentuan
      </a>
    </div>
  </div>
@endsection
