<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource as UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(UserRegisterRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'img' => 'user1',
            'adresse' => $request->adresse,
            'NContract' => $request->NContract,
            'NClient' => $request->NClient,
            'password' => bcrypt($request->password),
        ]);

        if (!$token = Auth::attempt($request->only(['email', 'password']))) {
            return abort(401);
        };


        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);
    }
    public function login(UserLoginRequest $request)
    {

        if (!$token = Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => ['Incorrect Email or Password']
            ], 422);
        };

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }



    public function update(Request $request, User $user)
    {
        $user->firstname = $request->get('firstname', $user->firstname);
        $user->email = $request->get('email', $user->email);
        $user->img = 'user1';
        $user->password = $request->get('password', $user->password);
        $user->lastname = $request->get('lastname', $user->lastname);
        $user->NClient = $request->get('NClient', $user->NClient);
        $user->NContract = $request->get('NContract', $user->NContract);
        $user->gender = $request->get('gender', $user->gender);
        $user->adresse = $request->get('adresse', $user->adresse);
        $user->save();
        return new UserResource($user);
    }
    public function index()
    {
        return User::all();
    }
}
