@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h1>Všetky príspevky</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Vytvoriť nový post</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulok</th>
                <th>Kategória</th>
                <th>Autor</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name ?? 'Žiadna' }}</td>
                    <td>{{ $post->user->name ?? 'Neznámy' }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Zobraziť</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Upraviť</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Naozaj chceš vymazať tento post?')">Vymazať</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection