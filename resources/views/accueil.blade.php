@extends('layouts.app')

@section('title', __('interface.home'))

@section('content')
<a href="{{ route('jeux.index') }}">{{ __('interface.view_games') }}</a>
@endsection