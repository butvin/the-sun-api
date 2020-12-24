<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Laravel\Lumen\Http\Request;

class UsersCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    public function __construct($resource)
    {
//        $this->resource->makeHidden([
//            'deleted_at',
//            'verified_at',
//            'created_at',
//            'updated_at',
//            'password',
//            'fb_token',
//            'gl_token',
//            'role_id',
//        ]);


        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Laravel\Lumen\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->collection = $this->collection->reject(fn($i, $key) => $i->status === 0);

        $this->collection->each(function($user){
            $user->role = $user->role()->first();
        });

        return [
            'data' => $this->collection,
            'links' => [
                'self' => (string)$request->getUri(),
            ],
            'meta' => [
                'current_page' => null,
                'from' => null,
                'last_page' => null,
                'path' => '',
                'per_page' => null,
                'to' => null,
                'total' =>$this->collection->count(),
            ],
        ];
    }
}
