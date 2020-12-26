<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Lumen\Http\Request;

class RoleResource extends JsonResource
{
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
