<h1>Liste des jeux</h1>
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