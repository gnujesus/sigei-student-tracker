<?php

$id = 0;

?>

<!DOCTYPE html>

@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer />

@section('content')
@auth

<!-- Modal -->
<div class="modal fade" id="create-new-building" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Give this building a name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/create-new-building" method="POST" class="d-flex flex-column gap-4">
                    @csrf
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="1B, 2C, 2F, 1A, ..." name="name">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

            </div>

            <div class="text-center">
                <h1 class="py-5">Buildings Manager</h1>

                <div class="container d-flex w-100 justify-content-center">
                    <form id='update-building-form' action="/manage-buildings/" class="d-flex w-75 flex-column gap-4"
                        method="POST">
                        @csrf
                        @method('PUT')


                        <div class="text-start d-flex justify-content-between align-items-end">
                            <div class="text-start w-75">
                                <label for="building" class="form-label fs-5">Building</label>
                                <select id="building-picker" class="form-select building-picker" aria-label="Building"
                                    name="building" required>
                                    @foreach ($buildings as $building)
                                    <option class="building-option" value="{{ $building->id }}">
                                        {{ $building->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="btn-group " role="group" aria-label="Basic example" style="height: 40px">
                                <button id="changes-button" class="btn" onclick="getAction()">
                                    Select
                                </button>
                            </div>
                        </div>


                        <div class="container w-100">
                            <a class="btn btn-light w-100" data-bs-toggle="modal"
                                data-bs-target="#create-new-building">Create new
                                building</a>
                        </div>

                        <div class="align-self-end">
                            <a href="/" class="btn btn-outline-danger">Cancel</a>
                            <button type="submit" class="btn btn-outline-success align-self-end" onclick="submit">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script defer>
    function getAction(buildings) {

        const selectedBuildingElement = document.querySelector('#building-picker');
        const selectedBuildingId = selectedBuildingElement.value;

        const submitButton = document.querySelector('#changes-button');


        buildings.forEach((building) => {
            if (selectedBuildingId == building['id']) {
                if (building['is_enabled'] > 0) {
                    submitButton.textContent = "Disable";
                    submitButton.className = 'btn btn-danger'
                } else {
                    submitButton.textContent = "Enable";
                    submitButton.className = 'btn btn-primary'
                }
            }
        })

        document.getElementById('update-building-form').action = `/manage-buildings/${selectedBuildingId}`;
        const variable = document.getElementById('update-building-form')
        console.log(variable);
    }

    document.querySelector('#building-picker').addEventListener('change', function() {
        getAction(@json($buildings)); // Pass classrooms data as JSON
    });
</script>
@else
@include('auth.login')

@endauth
@endsection
