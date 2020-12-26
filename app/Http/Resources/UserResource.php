<?php


namespace App\Http\Resources;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
//    /**
//     * The resource instance.
//     *
//     * @var mixed
//     */
//    public $resource;

//    public function __construct($resource)
//    {
//        parent::__construct($resource);
//    }

//    /**
//     * Indicates if the resource's collection keys should be preserved.
//     *
//     * @var bool
//     */
//    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Laravel\Lumen\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
//        return [
//            'id' => $this->id,
//            'role_id' => $this->role_id,
//            'name' => $this->name,
//            'email' => $this->email,
//            'phone' => $this->phone,
//            'status' => $this->status,
//            'password' => $this->password,
//            'api_token' => $this->api_token,
//            'gl_token' => $this->gl_token,
//            'fb_token' => $this->fb_token,
//            'verified_at' => $this->verified_at,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//            'deleted_at' => $this->deleted_at,
//            'role' => $this->role()->first(),
//            'token' => $this->userAccessToken()->first(),
//        ];
    }

//    /**
//     * Create an HTTP response that represents the object.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function toResponse($request)
//    {
//        return parent::toResponse($request);
//    }

    public function withResponse($request, $response)
    {
        $response->header('X-Butvin-Header', 'x-butvin-header-value');
    }
}
