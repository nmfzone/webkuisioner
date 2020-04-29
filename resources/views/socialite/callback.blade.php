@extends('layouts.app')

@section('content')
  <social-callback redirect-path="{{ $redirectPath }}"></social-callback>
@endsection
