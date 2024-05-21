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
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <!-- Display mentors for students -->
                    @if(auth()->user()->user_type === 'student')
                        @if (!$mentors->isEmpty())
                            <div class="mb-4">
                                <h3>Your Mentors</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Niveau</th>
                                            <th>Expertise</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentors as $mentor)
                                            <tr>
                                                <td>{{ $mentor->name }}</td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>{{ $mentor->niveau }}</td>
                                                <td>{{ implode(', ', json_decode($mentor->expertise)) }}</td>
                                                <!-- Affichage de l'expertise sans guillemets et parenthèses -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No mentors found.</p>
                        @endif
                    <!-- Display students for mentors -->
                    @elseif(auth()->user()->user_type === 'mentor')
                        @if (!$students->isEmpty())
                            <div class="mb-4">
                                <h3>Your Students</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Niveau</th>
                                            <th>Centre d'intérêt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->niveau }}</td>
                                                <td>{{ implode(', ', json_decode($student->interests)) }}</td>
                                                <!-- Affichage des centres d'intérêt sans guillemets et parenthèses -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No students found.</p>
                        @endif
                    <!-- Display all users for admin -->
                    @elseif(auth()->user()->user_type === 'admin')
                        @if (!$students->isEmpty())
                            <div class="mb-4">
                                <h3>Students</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Niveau</th>
                                            <th>Centre d'intérêt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->niveau }}</td>
        <td>{{ implode(', ', json_decode($student->interests)) }}</td>
        <!-- Affichage des centres d'intérêt sans guillemets et parenthèses -->
        <td>
            <!-- Ajoutez ici les boutons de modification et de suppression -->
            <a href="{{ route('users.edit', $student->id) }}" class="btn btn-primary">Modifier</a>
            <form action="{{ route('users.destroy', $student->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Supprimer</button>
            </form>
        </td>
    </tr>
@endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No students found.</p>
                        @endif

                        @if (!$mentors->isEmpty())
                            <div>
                                <h3>Mentors</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Niveau</th>
                                            <th>Expertise</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($mentors as $mentor)
    <tr>
        <td>{{ $mentor->name }}</td>
        <td>{{ $mentor->email }}</td>
        <td>{{ $mentor->niveau }}</td>
        <td>{{ implode(', ', json_decode($mentor->expertise)) }}</td>
        <!-- Affichage de l'expertise sans guillemets et parenthèses -->
        <td>
            <!-- Ajoutez ici les boutons de modification et de suppression -->
            <a href="{{ route('users.edit', $mentor->id) }}" class="btn btn-primary">Modifier</a>
            <form action="{{ route('users.destroy', $mentor->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Supprimer</button>
            </form>
        </td>
    </tr>
@endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No mentors found.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
