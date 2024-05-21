<!-- resources/views/admin_home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
         
           
    @include('layouts.sidebarAdmin')



            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tableau de bord de l'administrateur</div>

                    <div class="card-body">
                        <p class="card-text">Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
