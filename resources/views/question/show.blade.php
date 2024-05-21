@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    @if(auth()->user()->user_type === 'student')
    @include('layouts.sidebarStudent')
@elseif(auth()->user()->user_type === 'mentor')
    @include('layouts.sidebarMentor')
@elseif(auth()->user()->user_type === 'admin')
    @include('layouts.sidebarAdmin')
@endif

        <div class="col-md-8">
            <h1>Liste des questions</h1>
            <form action="{{ route('questions.search') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="query" class="form-control search-input" placeholder="Rechercher une question">
                    <button type="submit" class="btn btn-primary search-button">Rechercher</button>
                </div>
            </form>
            @if ($questions->isEmpty())
                <p>Aucune question n'a été trouvée.</p>
            @else
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($questions->reverse() as $question)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="text-gray-500 text-sm mb-2">{{ $question->created_at->format('d/m/Y H:i') }}</div>
                                    <h2 class="card-title">{{ $question->title }}</h2>
                                    <p class="card-text">{{ $question->content }}</p>
                                    <form action="{{ route('answers.store', $question) }}" method="post" data-url="{{ route('answers.store', $question) }}">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" rows="3" placeholder="Votre réponse"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Répondre</button>
                                        <a href="{{ route('answers.show', $question) }}" class="btn btn-secondary">Voir Réponse</a>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .sidebar-container {
        padding-right: 0;
    }

    .search-input {
        margin-right: 0;
    }

    .search-button {
        margin-left: -1px; /* Supprimer l'espace entre le champ de recherche et le bouton */
    }
</style>

@endsection
