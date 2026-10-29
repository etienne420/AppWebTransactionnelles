@extends('layouts.app')

@section('title', __('interface.edit_game'))

@section('content')
<h1>{{ __('interface.edit_game') }}</h1>

<form method="post" action="{{ route('jeux.update', $jeu) }}" enctype="multipart/form-data">
    @method('PATCH')
    @include('jeux._form')
</form>

<a href="{{ route('jeux.index') }}">{{ __('interface.view_games') }}</a>
@endsection