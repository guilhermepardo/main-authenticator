<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $model;
    
    public function __construct() {
        $this->model = new User();
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()
                    ->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $this->model->first_name = $request->firstName;
            $this->model->last_name = $request->lastName;
            $this->model->username = $request->username;
            $this->model->email = $request->email;
            $this->model->password = Hash::make($request->password);
    
            $this->model->save();

            return response()->json([], Response::HTTP_CREATED);
            
        } catch (\Exception $e) {
            throw $e;
        }
        

    }

}
