<?php

namespace App\Http\Resources\Api\User;

use App\Models\Api\Room\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $book_data = $this->resource;
        foreach ($book_data as $room_data){
            $data[] = [
                'room' => Room::where('id', $room_data['room_id'])->first(),
                'data' => [
                    'arrive_date' => $room_data['arrive_date'],
                    'confirm_status' => $room_data['book_status']
                ]
            ];
        }
        return [
            'data' => $data
        ];
    }
}
