{{-- @dd($data) --}}

@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('main')
    <section>
        <div class="show">
            <div class="mt-5 container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="image-container">
                            <img src="{{ $project['images'][0] }}" alt="Thumb not found">
                        </div>
                    </div>
                    <div class="col-6">
                        <h2 class="text-white">{{ $project['title'] }}</h2>
                        <h3 class="mt-5 text-white">Type : {{ $project->type?->name ?: 'Nessun tipo selezionato' }}</h3>
                        <div class="mt-5 text-white">
                            <h4>Technologies:</h4>
                            <ul>
                                @foreach ($project->technologies as $technology)
                                    <li>{{ $technology->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <p class="mt-5 text-white">{{ $project['description'] }}</p>
                        <h3 class="mt-5 text-white">Status : {{ $project['status'] }}</h3>
                        <div class="mt-5 d-flex text-white">
                            @if ($project['status'] != 'To Do')
                                <h4 class="">Start : {{ $project['start_date'] }}</h4>
                                @if ($project['status'] != 'WIP')
                                    <h4 class="mx-5">End : {{ $project['end_date'] }}</h4>
                                @endif
                            @endif
                        </div>

                        @if (auth()->check())
                            <div class="mt-5">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary mx-2"><i
                                        class="fas fa-pen"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger"
                                    type="submit">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
