<h1>Liste des jeux</h1>

@forelse ($jeux as $jeu)
    <article>
        <h2>
            <a href="{{ route('jeux.show', $jeu) }}">
                {{ $jeu->titre }}
            </a>
        </h2>

        <p>{{ $jeu->genre ?? 'Genre non précisé' }}</p>
    </article>
@empty
    <p>Aucun jeu à afficher.</p>
@endforelse

{{ $jeux->links() }}