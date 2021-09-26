<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'username'      => $this->username,
            'email'         => $this->email,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'roles'         => $this->getRoleNames(),
            'permissions'   => $this->getPermissionNames(),
            'created_at'    => date("d.m.Y", strtotime($this->created_at)),
        ];
    }
}
