<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Career;
use App\Models\Building;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    //
    public function registerVisit(Request $request){
        $data = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'career'=>'required',
            'email'=>'nullable',
            'building'=>'required',
            'classroom'=>'required',
            'arrival_time'=>'nullable',
            'leaving_time'=>'nullable',
            'visit_reason'=>'nullable',
        ]);

        $data['first_name'] = strip_tags($data['first_name']);
        $data['last_name'] = strip_tags($data['last_name']);
        $data['career_id'] = strip_tags($data['career']);
        $data['email'] = strip_tags($data['email']);
        $data['arrival_time'] = strip_tags($data['arrival_time']);
        $data['leaving_time'] = strip_tags($data['leaving_time']);
        $data['building_id'] = strip_tags($data['building']);
        $data['classroom_id'] = strip_tags($data['classroom']);
        $data['visit_reason'] = strip_tags($data['visit_reason']);

        $sql = $sql = "CALL validate_inserted_visit(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['arrival_time'],
            $data['leaving_time'],
            $data['career_id'],
            $data['building_id'],
            $data['classroom_id'],
            $data['visit_reason']
        ];
        
        DB::statement($sql, $params);

        return redirect('/');
    }

    public function deleteVisit(Visit $visit){
        $visit->delete();
        return redirect('/see-visits');
    }

    public function viewEditPage(Visit $visit){
        $buildings = Building::all();
        $classrooms = Classroom::all();
        $careers = Career::all();
        return view ('edit-visit', ['visit'=>$visit, 'buildings'=>$buildings, 'classrooms'=>$classrooms, 'careers'=>$careers]);
    }

    public function editVisit(Visit $visit, Request $request){
        $data = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'career'=>'required',
            'email'=>'nullable',
            'building'=>'required',
            'classroom'=>'required',
            'arrival_time'=>'nullable',
            'leaving_time'=>'nullable',
            'visit_reason'=>'nullable',
        ]);

        $data['first_name'] = strip_tags($data['first_name']);
        $data['last_name'] = strip_tags($data['last_name']);
        $data['career_id'] = strip_tags($data['career']);
        $data['email'] = strip_tags($data['email']);
        $data['arrival_time'] = strip_tags($data['arrival_time']);
        $data['leaving_time'] = strip_tags($data['leaving_time']);
        $data['building_id'] = strip_tags($data['building']);
        $data['classroom_id'] = strip_tags($data['classroom']);
        $data['visit_reason'] = strip_tags($data['visit_reason']);

        $visit->update($data);
        return redirect('/');
    }
}