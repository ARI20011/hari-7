<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir Ende')</title>
    <link rel="stylesheet" href="{{ asset('css/kasir.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <a class="brand" href="{{ route('katalog.index') }}">Kasir Ende</a>
        </div>
    </header>

    <main class="container page-content">
        @yield('content')
    </main>
</body>
</html>
