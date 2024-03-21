<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Http\Request;

class UserService {

    protected $model;
    
    const REGISTER_REQ_PARAMS_RULES = [
        'firstName' => 'required',
        'lastName' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required',
    ];
    public function __construct() {
        $this->model = new User();
    }

    public function createNewUser(Request $request):void {
        try {

            $this->model->first_name = $request->firstName;
            $this->model->last_name = $request->lastName;
            $this->model->username = $request->username;
            $this->model->email = $request->email;
            $this->model->password = \Hash::make($request->password);
    
            $this->model->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
