<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titlepage')</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        @include('header')
    </header>

    <main>
        @yield('content')
    </main>

    @include('footer')
</body>

</html>