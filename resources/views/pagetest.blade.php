@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Formulaire de Mentorat</h2>
        
        <div class="form-group">
            <label>Sujet sélectionné : {{ $selected_subject }}</label>
        </div>

        <div class="form-group">
            <label>Informations sur le sondage :</label>
            <ul>
                <li>Titre : {{ $survey['title'] }}</li>
                <li>Description : {{ $survey['description'] }}</li>
                <!-- Ajouter d'autres informations sur le sondage si nécessaire -->
            </ul>
        </div>

        <div class="form-group">
            <label>Étudiants :</label>
            <ul>
                @foreach ($students as $student)
                    <li>
                        Nom: {{ $student['name'] }}, Niveau: {{ $student['niveau'] }}
                    </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Ajouter d'autres champs et boutons de formulaire si nécessaire -->
    </div>
@endsection
