<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
        return response()->JSON(['data' => $users], 200);
    }

    public function createUser(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'phone_number' => 'required|unique:users',
            'handset_type' => 'required'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $user = User::create($data);
        return response()->JSON(['data' => $user], 201);
    }
    public function deleteUser($id)
    {
       $user=User::findorFail($id);
       $user->delete();
       return response()->JSON(['data'=>$user] , 200);

    }
    public function updateUser(Request $request,$id)
    {
       $user=User::findorFail($id);
       if($request->has('first_name')){
        $user->first_name=$request->first_name;   
      }
      if($request->has('last_name')){
        $user->last_name=$request->last_name;   
      }
      if($request->has('phone_number')){
        $user->phone_number=$request->phone_number;   
      }
      if($request->has('handset_type')){
        $user->handset_type=$request->handset_type;   
      }
      $user->save();
    return response()->JSON(['data' => $user], 201);

    }
}
