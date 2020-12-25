<?php


namespace App\Http\Resources;

use App\Http\Resources\Role as RoleResources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class User extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var mixed
     */
    public $resource;

    public function __construct($resource)
    {
        parent::__construct($resource);
//        $this->resource = $this->resource->where('status', '=', 1);
//        $this->resource->filter(function($item, $key) {
//            if ($item->status === 0) {
                //dd('bloccc');
//            }
//        });

//        $this->resource = $this->resource->each(function ($user, $key) {
//            return $user->status === 0;
//        });
    }

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Laravel\Lumen\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'role_id' => $this->role_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'password' => $this->password,
            'api_token' => $this->api_token,
            'gl_token' => $this->gl_token,
            'fb_token' => $this->fb_token,
            'verified_at' => $this->verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            //'role' => $this->role()->first(),
        ];
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return parent::toResponse($request);
    }

    public function withResponse($request, $response)
    {
        $response->header('X-Butvin-Header', 'x-butvin-header-value');
    }
}
