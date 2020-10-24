<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;
//use App\Models\Role;

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(CorsMiddleware::class);
    }

    /**
     * Show all users.
     *
     * * @return \Illuminate\Http\JsonResponse
     */
    public function index() :JsonResponse
    {
        $users = User::all();

        return ($users->count() > 0) ?
            response()->json($users, 200, []) :
            response()->json('There are no users', 200, []);
    }

    /**
     * Show user.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id) :JsonResponse
    {
        $user = User::find($id)->first();
        $user->role_id = $user::getUserRole($id);

        return ($user) ?
            response()->json($user, 200, []) :
            response()->json('error', 404, []);
    }

    /**
     * Create user
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) :JsonResponse
    {
        $attributes = $request->all();

        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['status'] = 1;
        $attributes['role_id'] = 3;
        $attributes['verified_at'] = time();

        $user = User::create($attributes);
        $user->save();

        return ($user) ?
            response()->json('User created', 201, []) :
            response()->json('error', 422, []);
    }
    /**
     * For future implements.
     */
    public function update()
    {
        // TODO: after front app
    }

    /**
     * For future implements.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id) :JsonResponse
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('error', 422);
        }
    }
}
