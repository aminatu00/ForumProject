@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="niveau" class="col-md-4 col-form-label text-md-end">{{ __('Niveau') }}</label>

                            <div class="col-md-6">
                                <select id="niveau" class="form-select" name="niveau" required>
                                    <option value="licence1">Licence 1</option>
                                    <option value="licence2">Licence 2</option>
                                    <option value="licence3">Licence 3</option>
                                    <option value="master1">Master 1</option>
                                    <option value="master2">Master 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="user_type" id="student" value="student" checked>
                                    <label class="form-check-label" for="student">
                                        {{ __('Student') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="user_type" id="mentor" value="mentor">
                                    <label class="form-check-label" for="mentor">
                                        {{ __('Mentor') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="expertise" class="row mb-3" style="display: none;">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Expertise') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="expertise[]" value="informatique">
                                    <label class="form-check-label">
                                        {{ __('Informatique') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="expertise[]" value="reseaux">
                                    <label class="form-check-label">
                                        {{ __('Réseaux') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="expertise[]" value="chimie">
                                    <label class="form-check-label">
                                        {{ __('Chimie') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="expertise[]" value="Math">
                                    <label class="form-check-label">
                                        {{ __('Math') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="expertise[]" value="Physique">
                                    <label class="form-check-label">
                                        {{ __('Physique') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="interests" class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Interests') }}</label>

                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]" value="informatique">
                                    <label class="form-check-label">
                                        {{ __('Informatique') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]" value="reseaux">
                                    <label class="form-check-label">
                                        {{ __('Réseaux') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]" value="chimie">
                                    <label class="form-check-label">
                                        {{ __('Chimie') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]" value="math">
                                    <label class="form-check-label">
                                        {{ __('Math') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interests[]" value="physique">
                                    <label class="form-check-label">
                                        {{ __('Physique') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var studentRadio = document.getElementById('student');
        var mentorRadio = document.getElementById('mentor');
        var interestsDiv = document.getElementById('interests');
        var expertiseDiv = document.getElementById('expertise');

        studentRadio.addEventListener('change', function () {
            interestsDiv.style.display = 'block';
            expertiseDiv.style.display = 'none';
        });

        mentorRadio.addEventListener('change', function () {
            interestsDiv.style.display = 'none';
            expertiseDiv.style.display = 'block';
        });
    });
</script>

@endsection
