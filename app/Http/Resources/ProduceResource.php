<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;
use App\Produces;


class ProduceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return dd($this->resource);
    }
}
