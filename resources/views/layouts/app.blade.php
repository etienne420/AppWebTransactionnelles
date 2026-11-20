<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('interface.games'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

    @auth
    <a href="{{ route('account.show') }}">{{ __('interface.my_account') }}</a>
    @if (auth()->user()?->role === \App\Models\User::ROLE_MANAGER)
        <a href="{{ route('admin.index') }}">{{ __('interface.administration') }}</a>
    @endif
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit">{{ __('interface.logout') }}</button>
    </form>
@else
    <a href="{{ route('login') }}">{{ __('interface.login') }}</a>
    <a href="{{ route('register') }}">{{ __('interface.register') }}</a>
@endauth

    <main>
        @if (session('status'))
            <p role="status">{{ session('status') }}</p>
        @endif
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>