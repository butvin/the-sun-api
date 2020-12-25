<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Http\Middleware\CorsMiddleware;

//use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


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
        $users = new UsersCollection(UserResource::collection(
            User::where('status', 1)->orderBy('id')->get()
        ));

        if ($users instanceof UsersCollection && $users->isEmpty()) {
            return response()->json(['msg' => 'no users found', ]);
        }

        return response()->json($users);
    }

    /**
     * Get user resource by id.
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(int $id): JsonResponse
    {
        $user = new UserResource(User::findOrFail($id));

        return response()->json($user);
    }

    /**
     * Create user and store
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
            $data = ['msg' => $validator->errors(), 'success' => false, ];

            return response()->json($data, 422);
        }

        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['api_token'] = Hash::make('bla-bla-bla-'.time());
        $attributes['status'] = 1;
        $attributes['role_id'] = 1;

        try {
            $user = User::create($attributes);
            $user->save();

            $data = [
                'msg' => 'successfully registered',
                'data' => $user,
                'success' => true,
            ];

            return response()->json($data, 201);
        } catch (\Exception $e) {
            $data = [
                'msg' => 'registration failed',
                'data' => $e->getMessage(),
                'success' => false,
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
        $user->delete();

        $data = [
            'msg' => 'successfully deleted',
            'data' => $user,
            'success' => true,
        ];

        return response()->json($data, 204);
    }
}
