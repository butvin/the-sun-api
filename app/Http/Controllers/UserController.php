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
        $users = User::where('status', 1)->get();

        $users->dd();

        return ($users->count() > 0) ?
            response()->json($users) :
            response()->json('No users');
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
        return response()->json(User::findOrFail($id));
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
        $attributes = $request->all();
        $response = ['msg' => null, 'status' => null, 'data' => null, ];

        $validator = Validator::make($attributes, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|max:320',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $response = [
                'msg' => 'failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, 422);
        }

        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['api_token'] = Hash::make($attributes['name'].$attributes['password']);
        $attributes['status'] = 1;
        $attributes['role_id'] = 1;

        try {
            $user = User::create($attributes);
            $user->save();

            $response = [
                'msg' => 'Successfully registered',
                'data' => $user,
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            $response['msg'] = 'Fail user registration';
            $response['errors'] = $e->getMessage();

            return response()->json($response);
        }
    }

    public function updateUser()
    {
        // TODO: after front app
    }

    /**
     * Destroy user (soft delete)
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyUser(int $id) :JsonResponse
    {
        $user = User::findOrFail($id);

        $user->status = 0;
        $user->save();
        $user->delete();

        return response()->json('Successfully deleted');
    }
}
