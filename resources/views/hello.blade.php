@extends('layouts.app')

@section('content')
  @if (isset($user))
    Ciao {{$user->name}}
    @else
    Ciao utente non loggato!
  @endif

@endsection
