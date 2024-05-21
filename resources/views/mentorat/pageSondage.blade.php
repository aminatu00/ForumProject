@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar -->
        @if(auth()->user()->user_type === 'student')
        @include('layouts.sidebarStudent')
        @elseif(auth()->user()->user_type === 'mentor')
        @include('layouts.sidebarMentor')
        @elseif(auth()->user()->user_type === 'admin')
        @include('layouts.sidebarAdmin')
        @endif

        <!-- Main Content -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recent Surveys') }}</div>
                <div class="card-body">
                    @foreach($surveys->sortByDesc('created_at') as $survey)
                    @if(auth()->user()->user_type === 'student')
                    <!-- Vérifier si l'étudiant est autorisé à voir ce sondage -->
                    @if(auth()->user()->niveau >= $survey->niveau && in_array($survey->subject, json_decode(auth()->user()->interests)))
                    <div class="survey">
                        <h4>{{ $survey->subject }}</h4>
                        <p>{{ $survey->question }}</p>
                        <p><strong>Domaine :</strong> {{ $survey->subject }}</p>
                        <p><strong>Date d'expiration :</strong> {{ $survey->expiry_date }}</p>
                        <!-- Afficher d'autres détails du sondage -->

                        <p><strong>Options :</strong></p>
                        <ul>
                            @php
                            $options = explode(',', $survey->options);
                            @endphp
                            @foreach($options as $option)
                            <li class="d-flex align-items-center justify-content-between">
                                <div>{{ $option }}</div>
                                <div>{{ $voteCounts[$option] ?? 0 }}</div>
                                @if(auth()->user()->user_type !== 'mentor')
                                <div>
                                    <form action="{{ route('vote.submit', [$survey->id, $option]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary vote-button" name="survey_id" value="{{ $survey->id }}">Voter</button>
                                    </form>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('view.survey', $survey->id) }}" class="btn btn-primary">Voir sondage</a>
                        <a href="{{ route('surveys.meetings', $survey->id) }}" class="btn btn-success">voir meets</a>
                        <hr> <!-- Délimitation -->
                    </div>

                    @endif
                    @else
                    <!-- Afficher tous les sondages pour les mentors et les administrateurs -->
                    <div class="survey">
                        <h4>{{ $survey->subject }}</h4>
                        <p>{{ $survey->question }}</p>
                        <p><strong>Domaine :</strong> {{ $survey->subject }}</p>
                        <p><strong>Date d'expiration :</strong> {{ $survey->expiry_date }}</p>
                        <p><strong>Options :</strong></p>
                        <ul>
                            @php
                            $options = explode(',', $survey->options);
                            @endphp
                            @foreach($options as $option)
                            <li class="d-flex align-items-center justify-content-between">
                                <div>{{ $option }}</div>
                                <div>{{ $voteCounts[$option] ?? 0 }}</div>
                            </li>
                            @endforeach
                        </ul>
                        <!-- Afficher d'autres détails du sondage -->
                        @if(auth()->user()->user_type === 'mentor' && auth()->user()->id === $survey->mentor_id)                        <a href="{{ route('view.survey', $survey->id) }}" class="btn btn-primary">Voir sondage</a>
                        <a href="{{ route('sondages.destroy', $survey->id) }}" class="btn btn-danger">Supprimer sondage</a>

                        <form action="{{ route('meetings.create') }}" method="GET">
    @csrf
    <!-- Champs cachés pour les étudiants, le domaine du sondage et les informations sur le sondage -->
   
   
    <input type="hidden" name="survey" id="survey" value="{{ json_encode($survey) }}">
    <input type="hidden" name="survey_id" value="{{ $survey->id }}">

    <!-- Vos autres champs de formulaire ici -->
    <button type="submit" class="btn btn-success">Create Meeting</button>
</form>




                        @endif
                        <hr> <!-- Délimitation -->
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .survey {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ccc;
    }

    .survey h4 {
        color: #333;
    }

    .survey p {
        margin-bottom: 10px;
    }
</style>
@endsection

@section('scripts')
<script>
    // Événement onchange pour mettre à jour les champs cachés lorsque l'utilisateur sélectionne un sondage
    document.getElementById('surveySelect').onchange = function() {
        var selectedSurvey = this.value;
        var surveyDetails = surveyData[selectedSurvey]; // Assurez-vous que surveyData contient les détails du sondage
        document.getElementById('selected_subject').value = surveyDetails.subject;
        document.getElementById('survey').value = JSON.stringify(surveyDetails);
    };
</script>
@endsection