@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title font-weight-bold">{{ $question->title }}</h2>
                    <p class="card-text">{{ $question->content }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Réponses</h3>
                </div>
                <div class="card-body">
                    @if($question->answers->isNotEmpty())
                        @foreach($question->answers as $answer)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar bg-primary rounded-circle mr-3" style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                            <span class="text-white font-weight-bold" style="line-height: 1;">{{ strtoupper(substr($answer->user->name, 0, 1)) }}</span>
                                        </div>
                                        <p class="card-text text-muted mb-0">{{ $answer->user->name }}</p>
                                    </div>

                                    <div id="answerContent_{{ $answer->id }}">
                                        <!-- Afficher le contenu de la réponse -->
                                        <p class="card-text">{{ $answer->content }}</p>
                                        <form action="{{ route('answers.like', $answer) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                J'aime <span class="badge badge-light ml-1">{{ $answer->likes }}</span>
                                            </button>
                                        </form>
                                        <!-- Bouton "Modifier" -->
                                        @if(auth()->user() && $answer->user_id === auth()->user()->id)
                                            <button class="btn btn-sm btn-outline-primary" onclick="editAnswer('{{ $answer->id }}')">Modifier</button>
                                        @endif
                                    </div>

                                    <!-- Formulaire de modification (initialement caché) -->
                                    <form id="editForm_{{ $answer->id }}" action="{{ route('answers.update', $answer) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <textarea class="form-control" name="content" rows="3">{{ $answer->content }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Aucune réponse disponible pour cette question.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Ajoutez ici votre contenu pour la colonne latérale -->
        </div>
    </div>
</div>

<script>
    function editAnswer(answerId) {
        // Masquer le contenu de la réponse
        document.getElementById('answerContent_' + answerId).style.display = 'none';
        // Afficher le formulaire de modification correspondant
        document.getElementById('editForm_' + answerId).style.display = 'block';
    }
</script>
@endsection
