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
        
        <div class="col-md-8 offset-md-0">
            <div class="card">
                <div class="card-header">{{ __('Meetings') }}</div>

                <div class="card-body">
                   
                        @if($meetings->isEmpty())
                            <p>No meetings found.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Meeting Link</th>
                                        <th>Subject</th>
                                        <th>Mentor</th>
                                        <th>Domaine</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->date }}</td>
                                        <td>{{ $meeting->time }}</td>
                                        <td><a href="{{ $meeting->meeting_link }}" target="_blank">{{ $meeting->meeting_link }}</a></td>
                                        <td>{{ $meeting->subject }}</td>
                                        <td>{{ $meeting->mentor->name }}</td> 
                                        <td>{{ $meeting->domaine }}</td> 
                                        <td>
                                            <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                            <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection