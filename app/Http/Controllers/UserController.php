<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Http\Middleware\CorsMiddleware;

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
        $user = User::create($attributes);
        $user->save();

        return ($user) ?
            response()->json($user, 201, []) :
            response()->json('error', 422, []); // mistake com un user
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
