@extends('layouts.base')

@section('content')
  <social-callback redirect-path="{{ $redirectPath }}"></social-callback>
@endsection
