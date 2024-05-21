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
            <div class="card">
                <div class="card-header">Profil Utilisateur</div>

                <div class="card-body">
                    <!-- Cercle avec le commencement du nom de l'utilisateur -->
                    <div class="circle">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <div>
                        <h3>{{ Auth::user()->name }}</h3>
                        <p>{{ Auth::user()->email }}</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: #007bff; /* Couleur de fond du cercle */
    color: #fff; /* Couleur du texte à l'intérieur du cercle */
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 48px; /* Taille du texte */
}

</style>