<?php

use App\Models\Visit;
use App\Models\Career;
use App\Models\Building;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ClassroomController;

Route::get('/', function () {
    $careers = Career::all();
    $buildings =  Building::all();
    $classrooms = Classroom::all();
    return view('home', ['buildings' => $buildings, 'classrooms'=> $classrooms, 'careers'=>$careers]);
});

Route::get('/see-visits', function(){
    $visits = Visit::all();
    
    return view ('see-visits', ['visits'=>$visits]);
});

Auth::routes();

// Home page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Visits
Route::post('/register-visit', [VisitController::class, 'registerVisit'])->name('register-visit');
Route::get('/edit-visit/{visit}', [VisitController::class,'viewEditPage']);
Route::put('/edit-visit/{visit}', [VisitController::class,'editVisit']);
Route::delete('/delete-visit/{visit}', [VisitController::class, 'deleteVisit']);

// Classrooms Management
Route::get('/manage-classrooms', [ClassroomController::class, 'viewClassroomsPage']);
Route::put('/manage-classrooms/{classroom}', [ClassroomController::class, 'updateClassroomState']);
Route::post('/create-new-classroom', [ClassroomController::class, 'create']);

// Buildings Management
Route::get('/manage-buildings', [BuildingController::class, 'viewBuildingsPage']);
Route::put('/manage-buildings/{building}', [BuildingController::class, 'updateBuildingState']);
Route::post('/create-new-building', [BuildingController::class, 'create']);

// User management
Route::get('/register-by-admin', function(){
    return view('register-by-admin');
});
Route::post('/register-by-admin', [UserController::class, 'create']);
