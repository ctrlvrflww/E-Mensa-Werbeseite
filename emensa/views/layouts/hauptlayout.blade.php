<!doctype html>
<html class="no-js" lang="DE">
<head>
    <meta charset="utf-8">
    <title>E-Mensa</title>
    <link rel="stylesheet" href="css/emensa.css">
</head>
<body>
@yield("header")

<main class="grid-3">
@yield("begrüßungstext")

@yield("gerichte")

    @yield("Meinung unserer Gaeste")
</main>
@yield("footer")
</body>
</html>
