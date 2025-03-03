<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>
</head>
<body>
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['excerpt'] }}</p>
    <a href="{{ url('/blog') }}">Späť na blog</a>
</body>
</html>
