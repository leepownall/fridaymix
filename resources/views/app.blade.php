<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    @inertiaHead
</head>
<body class="antialiased">
    @inertia
</body>
</html>
