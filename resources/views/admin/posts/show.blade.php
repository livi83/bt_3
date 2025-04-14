@extends('admin.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    
    <p><strong>Author:</strong> {{ $post->user->name }}</p>
    <p><strong>Category:</strong> {{ $post->category->name }}</p>
    
    <h3>Content</h3>
    <p>{{ $post->content }}</p>
    
    <h4>Tags</h4>
    <ul>
        @foreach ($post->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection
