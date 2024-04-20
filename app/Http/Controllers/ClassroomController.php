<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    //
    public function create(request $request){
        $data = $request->validate([
            'name'=>'required',
            'building'=>'required',
        ]);

        $data['name'] = strip_tags($data['name']);
        $data['building_id'] = strip_tags($data['building']);

        // if name and building_id are the same, it wont be added
        $existingClassroom = Classroom::where('name', $data['name'])->where('building_id', $data['building_id'])->first();

        if ($existingClassroom) {
            return redirect('/manage-classrooms');
        }

        Classroom::create($data);

        return redirect('/manage-classrooms');
    }
    public function viewClassroomsPage(){
        $classrooms = Classroom::all();
        $buildings = Building::all();
        return view ('manage-classrooms', ['classrooms' => $classrooms, 'buildings'=>$buildings]);
    }

    public function updateClassroomState(Classroom $classroom, Request $request){
        $data = $request->validate([
            'name'=>'requested',
            'building_id'=>'requested',
            'is_enabled'=>'requested'
        ]);
        if($classroom->is_enabled > 0){
            $data['is_enabled'] = 0;
        } else {
            $data['is_enabled'] = 1;
        }
        $classroom->update($data);

        return redirect('/manage-classrooms');
    }
}
