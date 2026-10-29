@extends('layouts.app')

@section('title', __('interface.game_details'))

@section('content')
<h1>{{ $jeu->titre }}</h1>

<p><strong>{{ __('interface.genre') }} :</strong> {{ $jeu->genre ?? __('interface.not_specified') }}</p>
<p><strong>{{ __('interface.year') }} :</strong> {{ $jeu->annee_sortie ?? __('interface.not_specified_f') }}</p>
<p>{{ $jeu->description ?? __('interface.no_description') }}</p>

@if ($jeu->image_path)
    <img src="{{ asset('storage/'.$jeu->image_path) }}"
         alt="{{ $jeu->titre }}">
@endif

<p><a href="{{ route('jeux.edit', $jeu) }}">{{ __('interface.edit') }}</a></p>

<form method="post" action="{{ route('jeux.destroy', $jeu) }}">
    @csrf
    @method('DELETE')
    <button type="submit">{{ __('interface.delete') }}</button>
</form>

<a href="{{ route('jeux.index') }}">{{ __('interface.back_to_list') }}</a>
@endsection