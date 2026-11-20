@extends('layouts.app')

@section('title', __('interface.my_account'))

@section('content')
    <h1>{{ __('interface.my_account') }} : {{ $user->name }}</h1>
    <h2>{{ __('interface.my_library') }}</h2>
    @forelse ($jeux as $jeu)
        <article>
            <h3><a href="{{ route('jeux.show', $jeu) }}">{{ $jeu->titre }}</a></h3>
            <form method="post" action="{{ route('bibliotheque.destroy', $jeu) }}">
                @csrf
                @method('DELETE')
                <button type="submit">{{ __('interface.remove_from_library') }}</button>
            </form>
        </article>
    @empty
        <p>{{ __('interface.empty_library') }}</p>
    @endforelse
    <p><a href="{{ route('home') }}">{{ __('interface.home') }}</a></p>
@endsection
