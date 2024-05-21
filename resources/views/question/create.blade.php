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

        <div class="col-md-4">
            <div class="card-header bg-primary text-white">
                <h1 class="text-center">Poser une nouvelle question</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('questions.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie</label>
                        <select name="categorie" id="categorie" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Entrez le titre de votre question">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <textarea name="content" id="content" rows="5" class="form-control" placeholder="Entrez le contenu de votre question"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div>
        </div>
    </div>

   <!-- Inclure le contenu de sidebar.blade.php -->
@endsection
@section('scripts')
<script>
    // Écouter les changements de sélection dans le menu déroulant
    document.getElementById('categorie').addEventListener('change', function() {
        // Récupérer la valeur sélectionnée
        var selectedCategory = this.value;

        // Rediriger vers la page affichant toutes les questions liées à la catégorie sélectionnée
        window.location.href = '/categorie/' + selectedCategory;
    });
</script>
@endsection
