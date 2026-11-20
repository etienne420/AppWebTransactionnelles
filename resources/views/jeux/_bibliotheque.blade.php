@if ($dansBibliotheque)
    <form method="post" action="{{ route('bibliotheque.destroy', $jeu) }}">
        @csrf
        @method('DELETE')
        <button type="submit">{{ __('interface.remove_from_library') }}</button>
    </form>
@else
    <form method="post" action="{{ route('bibliotheque.store', $jeu) }}">
        @csrf
        <button type="submit">{{ __('interface.add_to_library') }}</button>
    </form>
@endif
