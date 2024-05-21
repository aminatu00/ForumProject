@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.sidebarMentor')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Meeting') }}</div>


                <div class="card-body">
                    <form method="POST" action="{{ route('meetings.store') }}">
                        @csrf
                    
w
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                            <input type="hidden" name="survey_id" value="{{ $survey['id'] ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="domaine" class="col-md-4 col-form-label text-md-right">{{ __('Domaine') }}</label>
                            <div class="col-md-6">
                                <input id="domaine" type="text" class="form-control" name="domaine" value="{{ $survey['subject'] }}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                                <select id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" required>
                                    @php
                                    $options = explode(',', $survey['options']);
                                    @endphp
                                    @foreach($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autofocus>

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required>

                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="meeting_link" value="{{ old('link') }}" required>

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Meeting') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection