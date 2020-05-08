@extends('layouts.web', ['width' => 'md:w-4/6'])

@section('content-lv2')
  <h3 class="text-2xl font-normal">Syarat & Ketentuan</h3>

  <div class="content mt-5 font-light btw">
    {!! $site->privacy_policy !!}
  </div>
@endsection
