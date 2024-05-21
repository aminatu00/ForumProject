@extends('layouts.app')

@section('content')
   
        <div class="row">
            <!-- Inclusion de la barre latérale -->
    @include('layouts.sidebarStudent')

            <!-- Contenu principal -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tableau de bord de l'etudiantttttttttttttttttttt</div>

                    <div class="card-body">
                        <p class="card-text">Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</p>
                    </div>
                </div>
            </div>
        </div>
   
@endsection
