@extends('app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Emailová adresa</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Zadajte váš email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Heslo</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Zadajte vaše heslo" required>
        @error('password')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Prihlásiť sa</button>

    @if (Route::has('password.request'))
        <div class="mt-3">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Zabudli ste heslo?
            </a>
        </div>
    @endif
</form>
</div>
@endsection