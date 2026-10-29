@extends('layouts.app')

@section('title', __('interface.create_game'))

@section('content')
<h1>{{ __('interface.create_game') }}</h1>
<form method="post" action="{{ route('jeux.store') }}" enctype="multipart/form-data">
    @include('jeux._form', ['jeu' => null])
</form>

<a href="{{ route('jeux.index') }}">{{ __('interface.view_games') }}</a>

@endsection