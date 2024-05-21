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

        <div class="col-md-6"> <!-- Utilisez moins de colonnes pour le contenu principal -->

            <!-- Afficher les messages d'erreur -->
            @if ($errors->any())
            <div class="alert alert-danger auto-dismiss">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h1>Liste des questions</h1>
            <form action="{{ route('questions.search') }}" method="GET" class="mb-3">
                <input type="hidden" name="category_id" value="{{ isset($category) ? $category->id : null }}">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Rechercher une question">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </form>

            @if (isset($questions) && $questions->isEmpty())
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
                                <!-- Bouton "like" avec le nombre de likes -->
                               
                                <!-- Fin du bouton "like" -->
                            </form>
                           <form action="{{ route('questions.like', $question) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Like <span class="badge badge-light">{{ $question->likes }}</span></button>
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

<!-- Ajouter le code JavaScript pour masquer automatiquement les messages d'erreur -->
<script>
    // Attendre 3 secondes avant de masquer les messages d'erreur automatiquement
    setTimeout(function() {
        document.querySelectorAll('.auto-dismiss').forEach(function(element) {
            element.style.display = 'none';
        });
    }, 3000);
</script>

@endsection