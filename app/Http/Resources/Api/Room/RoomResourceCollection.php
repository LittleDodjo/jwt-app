<?php

namespace App\Http\Resources\Api\Room;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomResourceCollection extends ResourceCollection
{


    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = $this->collection->count();
        return [
            'count' => $count,
            'data' => $this->collection,
//            'per_page' => $this->perPage(),
//            'current_page' => $this->currentPage(),
//            'total_pages' => $this->lastPage(),
        ];
    }
}
