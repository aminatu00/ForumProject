@extends('layouts.app')

@section('content')
    
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
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                        @foreach ($notifications as $notification)
                            <div class="alert alert-info" role="alert">
                                @if(isset($notification->data['message']))
                                    {{ $notification->data['message'] }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
       
    </div>
@endsection
