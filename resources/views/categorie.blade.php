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

        <div class="col-md-6">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-6 mb-4">
  <a href="{{ route('categorie.show', ['id' => $category->id, 'category_id' => $category->id]) }}" class="category-link">                        <div class="card square-card" style="background-color: purple;">
                            <div class="card-body">
                                <h3 class="card-title text-white">{{ $category->nom }}</h3>
                                <p class="card-text text-white">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> -->
<style>
    .square-card {
        width: 100%;
        height: 200px;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .square-card:hover {
        transform: scale(1.05);
    }

    .category-link {
        text-decoration: none;
    }
</style>
@endsection
