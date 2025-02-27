<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <h1>Blogové články</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <h2>{{ $post['title'] }}</h2>
                <p>{{ $post['excerpt'] }}</p>
            </li>
        @endforeach
    </ul>

</body>
</html>
