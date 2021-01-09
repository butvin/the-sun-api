<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Support\Collection;
use Laravel\Lumen\Http\Request;

class UsersCollection extends ResourceCollection
{
//    /**
//     * The mapped collection instance.
//     *
//     * @var \Illuminate\Support\Collection
//     */
//    public $collection;

    public function __construct($resource)
    {
        parent::__construct($resource);

        // Drop from the Collection all users who blocked (when status equal '0')
        $rejected = $this->collection->reject(
            fn($item) => !($item->status ?? 0)
        );

        // Attaching role's data to users resource instead 'role_id' attributes values.
        $this->collection = $rejected->each(function($user) {
            $user->role = $user->role()->first();
            $user->user_access_token = $user->userAccessToken()->first();
            //$user->isAdmin = $user->when($user->role()->first()->name === 'admin', 'true');
        });
    }

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
    }
}
