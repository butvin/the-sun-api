<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;
//use App\Models\Role;

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Hash;

use function MongoDB\BSON\toJSON;

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
        $role = User::find($id)->role->first();

        $user->role_id = $role;

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
//        $attributes['created_at'] = time();
//        $attributes['updated_at'] = time();
        $attributes['status'] = 1;
        $attributes['role_id'] = 3;
        $attributes['verified_at'] = time();

        $user = User::create($attributes);
        $user->save();

        return ($user) ?
            response()->json('User created', 201, []) :
            response()->json('error', 422, []); // TODO: some code &  some error
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
//    public function register(Request $request)
//    {
//        $this->validate($request, User::registerRules());
//        $attributes = $request->all();
//        //        $attributes = $request->only('full_name', 'email', 'phone', 'password');
//        $subject = (isset($attributes['email'])) ? 'email' : 'phone';
//
//
//        $user = User::create($attributes);
//        $user->save();
//        $confirmation = $this->createConfirmation($user->id);
//
//        $this->sendConfirmationEmail($confirmation->code, $user->email);
//
//        $data = [
//            'created_user' => $user,
//            'confirmation' => $confirmation,
//        ];
//        $msg = 'The verification code was send to your '. $user->email;
//        return $this
//            ->sendJsonResponse( $data, $msg, 201)
//            ->setCallback('callback');
//    }

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

//    /**
//     * Handle user authentication by email or phone with password.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     *
//     * @return \Illuminate\Http\JsonResponse
//     * @throws \Illuminate\Validation\ValidationException
//     */
//    public function login(Request $request) :JsonResponse
//    {
//        $attributes = $request->all();
//
////        $this->validate($request, User::loginRules());
//        $token = null;
//
//        if ( $user = User::isVerified($attributes) ) {
//            // Check the user status
//            if ($user->status == null) {
//                return $this->sendJsonError(422, 'This user is blocked.');
//            }
//            // Check the user is verified
//            if ($user->verified == null) {
//                return $this->sendJsonError(422, 'This user is not verified.');
//            }
//            // Generate access token for specific user
//            $accessToken = $this->createAccessToken($user->id);
//            $data = [];
//            $data['access_token'] = $accessToken->token;
//            $data['expires_at'] = $accessToken->expires_at;
//
//            return $this->sendJsonResponse($data, 'Authentication is successful!', 200)
//                ->setCallback($request->input('callback'));
//        } else {
//            return $this->sendJsonError(422, 'Wrong login or password.')
//                ->setCallback($request->input('callback'));
//        }
//    }

}
