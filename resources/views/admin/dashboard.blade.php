@extends('layouts.app')

@section('content')
    {{-- @dd($projects) --}}

    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="col mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div> --}}

        <table class="mt-3 table text-white">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Operazioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    {{-- @dd($project->slug) --}}
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->status }}</td>
                        <td>{{ $project->type->name }}</td>
                        <td>
                            {{-- SHOW --}}
                            <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-primary"><i
                                    class="fas fa-eye"></i></a>


                            {{-- EDIT --}}
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn bg-warning mx-2"><i
                                    class="fas fa-pen"></i></a>

                            {{-- DELETE --}}
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger"
                                type="submit">
                                <i class="fas fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <ul>
        </ul>

    </div>
@endsection
