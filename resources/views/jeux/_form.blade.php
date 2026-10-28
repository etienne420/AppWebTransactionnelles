@csrf

<label for="titre">Titre</label>
<input id="titre" name="titre" value="{{ old('titre', $jeu?->titre) }}">
@error('titre') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="genre">Genre</label>
<input id="genre" name="genre" value="{{ old('genre', $jeu?->genre) }}">
@error('genre') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="annee_sortie">Année de sortie</label>
<input
    id="annee_sortie"
    name="annee_sortie"
    type="number"
    value="{{ old('annee_sortie', $jeu?->annee_sortie) }}"
>
@error('annee_sortie') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="description">Description</label>

<br>

<textarea id="description" name="description">{{ old('description', $jeu?->description) }}</textarea>
@error('description') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="image">Image</label>
<input id="image" name="image" type="file"
       accept="image/jpeg,image/png,image/webp">
@error('image') <p>{{ $message }}</p> @enderror

<br>
<br>

<button type="submit">Enregistrer</button>