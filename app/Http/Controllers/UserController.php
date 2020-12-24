<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UsersCollection;
use App\Http\Middleware\CorsMiddleware;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


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
     * Show all active users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        $users = new UsersCollection(
            UserResource::collection(User::all())
        );

        if ($users instanceof UsersCollection && $users->isEmpty()) {
            $data = [
                'msg' => 'there are no users',
                'success' => 1,
            ];

            return response()->json($data, 204);
        }

        return response()->json($users);
    }

    /**
     * Get user by id.
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(int $id): JsonResponse
    {
        $user = new UserResource(User::findOrFail($id));

        $data = [
            'data' => $user,
            'success' => 1,
        ];

        return response()->json($data);
    }

    /**
     * Create user
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $attributes = $request->all();

        $validator = Validator::make($attributes, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|max:320',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $data = [
                'msg' => $validator->errors(),
                'success' => 0,
            ];

            return response()->json($data, 422);
        }

        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['api_token'] = Hash::make('bla-bla-bla-'.(string)time());
        $attributes['status'] = 1;
        $attributes['role_id'] = 1;

        try {
            $user = User::create($attributes);
            $user->save();

            $data = [
                'msg' => 'successfully registered',
                'data' => $user,
                'success' => 1,
            ];

            return response()->json($data, 201);
        } catch (\Exception $e) {
            $data = [
                'msg' => 'fail user registration',
                'data' => $e->getMessage(),
                'success' => 1,
            ];

            return response()->json($data);
        }
    }

    public function updateUser()
    {
        // todo: ...
    }

    /**
     * Destroy user (soft delete)
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyUser(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
        $user->delete();

        $data = [
            'msg' => 'user successfully deleted',
            'data' => $user,
            'success' => 1,
        ];

        return response()->json($data, 204);
    }
}
