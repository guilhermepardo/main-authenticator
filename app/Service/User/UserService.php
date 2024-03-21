<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserService
{

    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function createNewUser(Request $request): void
    {
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

    public function registerRequestRules(): array
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            'passwordConfirmation' => 'required|same:password',
        ];
    }

}
