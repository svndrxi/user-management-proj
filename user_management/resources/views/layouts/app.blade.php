<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }} &mdash; @yield('title', 'Dashboard')</title>
    @stack('styles')
</head>
<body>

    {{-- TOP BAR --}}
    <div id="topbar">
        <span id="topbar-brand">{{ config('app.name', 'Admin Panel') }}</span>

        <span id="topbar-breadcrumb">
            @yield('breadcrumb', 'Home')
        </span>

        <span id="topbar-right">
            <span id="topbar-datetime"></span>
            &nbsp;|&nbsp;
            Logged in as: <strong>{{ Auth::user()->name ?? 'Guest' }}</strong>
            &nbsp;|&nbsp;
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </span>
    </div>

    <div id="layout">

        {{-- SIDEBAR --}}
        <nav id="sidebar">
            <ul>

                {{-- Home --}}
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                {{-- Account / Profile --}}
                <li>
                    <span>Account / Profile</span>
                    <ul>
                        <li>
                            <a href="{{ route('profile.show') }}"
                               class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
                                My Profile
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

        {{-- MAIN CONTENT --}}
        <main id="content">

            {{-- Page Heading --}}
            <h1>@yield('page-title', 'Dashboard')</h1>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')

        </main>

    </div><!-- /#layout -->

    {{-- Clock Script --}}
    <script>
        function updateClock() {
            const el = document.getElementById('topbar-datetime');
            if (el) el.textContent = new Date().toLocaleString();
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

    @stack('scripts')

</body>
</html>