{{-- @dd($data) --}}

@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('content')
    <section>
        @if (auth()->check())
            <div class="add-project">
                <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">ADD NEW PROJECT</a>
            </div>
        @endif
        <div class="container">
            <div class="projects-list">
                @foreach ($data['projects'] as $project)
                    <div class="project-card">
                        <a href="{{ route('admin.projects.show', $project->slug) }}">
                            <div class="image-container">
                                <img src="{{ $project['images'][0] }}" alt="Thumb not found">
                            </div>
                            <div class="title-container">
                                <p>{{ $project['title'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
