<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
     <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header>
        <h1 class="header__title">
            <a href="/products">mogitate</a>
        </h1>
    </header>
    <main>
        @yield('content')
    </main>
    
</body>
</html>