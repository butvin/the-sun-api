<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
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
    public function getAllUsers() :JsonResponse
    {
        $users = User::all()->where('status', '=', 1);

        return ($users->count() > 0) ?
            response()->json($users) :
            response()->json('There are no users', 202);
    }

    /**
     * Show user by id.
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(int $id) :JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            //$user->role_id = $user::getUserRole($id);
        } catch (\Throwable $t) {
            return response()->json([$t->getMessage(), ],404);
        }

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
    public function register(Request $request) :JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|max:320',
//            'phone' => 'int',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422, []);
        }

        $attributes = $request->all();

        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['status'] = 1;
        $attributes['role_id'] = 3;
        $attributes['verified_at'] = time();

        try {
            $user = User::create($attributes);
            $user->save();
        } catch (\Exception $e) {
            return response()->json($e, 422, []);
        }

        return ($user) ?
            response()->json('successfully registered', 201, []) :
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
