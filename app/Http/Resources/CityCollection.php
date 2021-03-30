<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
    
            'data' => [
                'id'    =>  $this->id,
            ],
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}