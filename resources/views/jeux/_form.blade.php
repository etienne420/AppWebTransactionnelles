@csrf

<label for="titre">{{ __('interface.title') }}</label>
<input id="titre" name="titre" value="{{ old('titre', $jeu?->titre) }}">
@error('titre') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="genre">{{ __('interface.genre') }}</label>
<input id="genre" name="genre" value="{{ old('genre', $jeu?->genre) }}">
@error('genre') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="annee_sortie">{{ __('interface.release_year') }}</label>
<input
    id="annee_sortie"
    name="annee_sortie"
    type="number"
    value="{{ old('annee_sortie', $jeu?->annee_sortie) }}"
>
@error('annee_sortie') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="description">{{ __('interface.description') }}</label>

<br>

<textarea id="description" name="description">{{ old('description', $jeu?->description) }}</textarea>
@error('description') <p>{{ $message }}</p> @enderror

<br>
<br>

<label for="image">{{ __('interface.image') }}</label>
<input id="image" name="image" type="file"
       accept="image/jpeg,image/png,image/webp">
@error('image') <p>{{ $message }}</p> @enderror

<br>
<br>

<button type="submit">{{ __('interface.save') }}</button>