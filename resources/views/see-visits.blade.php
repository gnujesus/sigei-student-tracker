<!DOCTYPE html>

@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="d-flex flex-column gap-4">
            <h1 class="mt-5">Visits History</h1>
            @foreach ($visits as $visit)
                <div class="card">
                    <div class="card-header pt-3">
                        <h5>{{ $visit->first_name }} {{ $visit->last_name }}</h5>
                    </div>
                    <div class="card-body text-muted">
                        <div>
                            <p>Database ID: {{ $visit->id }}, Career: {{ $visit->career->name }}...</p>
                        </div>


                        <div class="collapse mb-2" id="{{ $visit->id }}">
                            <div class="card card-body">
                                <p>Database ID: {{ $visit->id }}</p>
                                <p>Full Name: {{ $visit->first_name }} {{ $visit->last_name }}</p>
                                <p>Email: {{ $visit->email }}</p>
                                <p>Arrival Time: {{ $visit->arrival_time }}</p>
                                <p>Leaving Time: {{ $visit->leaving_time }}</p>
                                <p>Visit Reason: {{ $visit->visit_reason }}</p>

                                @if (auth()->user()->is_admin > 0)
                                    <a href="/edit-visit/{{ $visit->id }}" type="button" class="btn btn-light"
                                        data-toggle="modal" data-target="#exampleModal">
                                        Edit
                                    </a>
                                @endif

                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $visit->id }}" aria-expanded="false"
                                aria-controls="{{ $visit->id }}">
                                View Detailed Info
                            </button>
                            @if (auth()->user()->is_admin > 0)
                                <form action="/delete-visit/{{ $visit->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
