@extends('layouts.app')

@section('content')
   
        <div class="row">
            <!-- Inclusion de la barre latérale -->
           
    @include('layouts.sidebarMentor')



            <!-- Contenu principal -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tableau de bord du mentor</div>

                    <div class="card-body">
                        <p class="card-text">Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</p>
                    </div>
                </div>
            </div>
        </div>
   
@endsection
