@extends('layouts.app')

@section('title', __('interface.list'))

@section('content')

<h1>{{ __('interface.list') }}</h1>

<label for="search">{{ __('interface.search') }}</label>
<input id="search" type="search" autocomplete="off"
       data-search-url="{{ route('recherche.jeux') }}"
       data-searching="{{ __('interface.searching') }}"
       data-empty="{{ __('interface.no_results') }}"
       data-count="{{ __('interface.results') }}"
       data-error="{{ __('interface.search_error') }}">
<p id="search-status" role="status" aria-live="polite"></p>
<ul id="search-results"></ul>

@forelse ($jeux as $jeu)
    <article>
        <h2>
            <a href="{{ route('jeux.show', $jeu) }}">
                {{ $jeu->titre }}
            </a>
        </h2>
    </article>
@empty
    <p>{{ __('interface.no_games') }}</p>
@endforelse

<a href="{{ route('jeux.create') }}">{{ __('interface.add_game') }}</a>
{{ $jeux->links() }}
@endsection

@push('scripts')
<script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush