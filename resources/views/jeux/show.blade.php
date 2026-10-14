<h1>{{ $jeu->titre }}</h1>

<p><strong>Genre :</strong> {{ $jeu->genre ?? 'Non précisé' }}</p>
<p><strong>Année :</strong> {{ $jeu->annee_sortie ?? 'Non précisée' }}</p>
<p>{{ $jeu->description ?? 'Aucune description.' }}</p>

<a href="{{ route('jeux.index') }}">Retour à la liste</a>