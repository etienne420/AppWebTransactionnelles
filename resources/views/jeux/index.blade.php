<h1>Liste des jeux</h1>

<label for="search">Rechercher un jeu</label>
<input id="search" type="search" autocomplete="off"
       data-search-url="{{ route('recherche.jeux') }}"
       data-searching="Recherche en cours..."
       data-empty="Aucun résultat."
       data-count=":count résultat(s)."
       data-error="Recherche temporairement indisponible.">
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

<script src="{{ asset('js/recherche.js') }}" defer></script>