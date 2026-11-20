@extends('layouts.app')

@section('title', __('interface.administration'))

@section('content')
    <h1>{{ __('interface.administration') }}</h1>
    <h2>{{ __('interface.accounts') }}</h2>

    <table>
        <thead>
            <tr>
                <th>{{ __('interface.name') }}</th>
                <th>{{ __('interface.email') }}</th>
                <th>{{ __('interface.role') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><a href="{{ route('home') }}">{{ __('interface.home') }}</a></p>
@endsection
