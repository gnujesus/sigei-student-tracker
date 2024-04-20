<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required',
            'is_admin' => 'required',
        ]);

        $sql = "CALL validate_user(?, ?, ?, ?)";
        
        $params=[
            $data['name'],
            $data['email'], 
            $data['password'],
            $data['is_admin'],
        ];

        DB::statement($sql, $params);

        return redirect('/');
    }
}
