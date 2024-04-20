<!DOCTYPE html>

@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer />

@section('content')
@auth
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

            </div>

            <div class="text-center mb-2">
                <h1 class="m-5 ">Register a new visitant</h1>

                <div class="container d-flex w-100 justify-content-center">
                    <form id='register-visit-form' action="/register-visit" class="d-flex w-75 flex-column gap-4"
                        method="POST">
                        @csrf
                        <div class="d-flex justify-content-between gap-4">
                            <div class="text-start w-75">
                                <label for="first_name" class="form-label fs-5">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Alberto"
                                    required>
                            </div>

                            <div class="text-start w-75">
                                <label for="last_name" class="form-label fs-5">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Caffaretti"
                                    required>
                            </div>
                        </div>


                        <div class="text-start">
                            <label for="career" class="form-label fs-5">Career</label>
                            <select class="form-select" aria-label="Career" name="career" required>
                                <option selected>Select Career</option>
                                @foreach ($careers as $career)
                                <option selected value={{ $career->id }}>{{ $career->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-start">
                            <label for="email" class="form-label fs-5">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="jondoe@gmail.com"
                                required>
                        </div>


                        <div class="d-flex justify-content-between gap-4">
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

                            <div class="text-start w-75">
                                <label for="classroom" class="form-label fs-5">Classroom</label>
                                <select id="classroom-picker" class="form-select" aria-label="Classroom"
                                    name="classroom" required>
                                    <option selected class="classroom-option">Select Classroom</option>
                                    @foreach ($classrooms as $classroom)
                                    @if ($classroom->is_enabled > 0)
                                    <option class="classroom-option" value="{{ $classroom->building_id }}">
                                        {{ $classroom->name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between gap-4">
                            <div class="d-flex flex-column gap-2 text-start">
                                <label for="arrival_time" class="form-label fs-5">Arrival Time</label>
                                <x-flatpickr class="border bg-ligh" show-time name="arrival_time" />
                            </div>

                            <div class="d-flex flex-column gap-2 text-start">
                                <label for="leaving_time" class="form-label fs-5">Leaving Time</label>
                                <x-flatpickr class="border bg-light" show-time name="leaving_time" />
                            </div>
                        </div>
                        <div class="text-start">
                            <label for="visit_reason" class="form-label fs-5">Visit Reason</label>
                            <textarea class="form-control" name="visit_reason"
                                placeholder="Write the reason here..."></textarea>
                        </div>

                        <button class="btn btn-outline-success align-self-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function getOption(classrooms) { // Receive classrooms data as an argument


        // Clear dropdown, before lgic
        document.querySelector('#classroom-picker').textContent = "";

        // Get the selected building element
        const selectedBuildingElement = document.querySelector('#building-picker');
        const selectedBuildingId = selectedBuildingElement.value;


        classrooms.forEach(classroom => {
            if (classroom.building_id == selectedBuildingId && classroom.is_enabled > 0) {
                const newOption = document.createElement('option');
                newOption.value = classroom.id;
                newOption.textContent = classroom.name;
                document.querySelector('#classroom-picker').appendChild(newOption);
            }
        })

    }

    document.querySelector('#building-picker').addEventListener('change', function() {
        console.log("Building selection changed!"); // Debugging log
        getOption(@json($classrooms)); // Pass classrooms data as JSON

    });
</script>
@else
@include('auth.login')

@endauth

@endsection
