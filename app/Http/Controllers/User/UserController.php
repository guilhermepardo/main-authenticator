<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Service\User\UserService;

class UserController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function store(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), $this->service::REGISTER_REQ_PARAMS_RULES);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $this->service->createNewUser($request);

            return response()->json([], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            throw $e;
        }

    }

}
