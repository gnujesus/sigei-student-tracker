<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'name'=>['required', 'unique:buildings'],
        ]);

        Building::create($data);

        return redirect('/manage-buildings');
    }

    //
    public function viewBuildingsPage(){
        $buildings = Building::all();
        return view ('manage-buildings', ['buildings' => $buildings]);
    }

    public function updateBuildingState(Building $building, Request $request){
        $data = $request->validate([
            'name'=>'requested',
            'is_enabled'=>'requested'
        ]);
        if($building->is_enabled > 0){
            $data['is_enabled'] = 0;
        } else {
            $data['is_enabled'] = 1;
        }
        $building->update($data);

        return redirect('/manage-buildings');
    }
}
