@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-light p-5 rounded-lg">
                    <h1 class="display-4">Vitajte na našom blogu!</h1>
                    <p class="lead">Tu nájdete najnovšie články a zaujímavosti.</p>
                    <hr class="my-4">
                    <p>Prečítajte si naše najnovšie blogové príspevky nižšie.</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Zistiť viac</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Najnovšie blogové príspevky</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"> {{-- Zmenili sme stĺpec na plnú šírku --}}
                @forelse ($posts as $post)
                    <div class="mb-4"> {{-- Pridali sme margin-bottom pre oddelenie príspevkov --}}
                        <h3>{{ $post->title }}</h3>
                        <p>{{ Str::limit($post->content, 200) }}</p> {{-- Zvýšili sme dĺžku excerptu --}}
                        <hr class="my-3"> {{-- Pridali sme horizontálnu čiaru pre vizuálne oddelenie --}}
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="lead">Momentálne tu nie sú žiadne blogové príspevky.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection