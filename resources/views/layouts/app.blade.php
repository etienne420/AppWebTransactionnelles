<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('interface.games'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('scripts')
</head>

<body>

    <form method="post" action="{{ route('locale.update') }}">
        @csrf
        <label for="locale">{{ __('interface.language') }}</label>
        <select id="locale" name="locale">
            <option value="fr" @selected(app()->getLocale() === 'fr')>{{ __('interface.french') }}</option>
            <option value="en" @selected(app()->getLocale() === 'en')>{{ __('interface.english') }}</option>
        </select>
        <button type="submit">{{ __('interface.apply') }}</button>
    </form>

    <main>
        @yield('content')
    </main>
</body>

</html>