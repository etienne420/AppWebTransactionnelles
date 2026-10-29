@extends('layouts.app')

@section('title', 'Liste des jeux')

@section('content')
<h1>Liste des jeux</h1>

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
    <p>Aucun jeu à afficher.</p>
@endforelse

<a href="{{ route('jeux.create') }}">Ajouter un jeu</a>
{{ $jeux->links() }}
@endsection

@push('scripts')
<script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush