<?php

namespace App\Http\Resources\Api\Room;

use App\Http\Resources\Api\User\UserResource;
use App\Models\Api\Room\Book;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Room\RoomResource;

class BookResource extends JsonResource
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
            'user_data' => [
                new UserResource(
                    User::where('id', $this->resource->user_id)->first()
                )
            ],
            'room_data' => [
                'book_status' => $this->resource->book_status ? "confirmed" : "unconfirmed"
            ]
        ];
    }
}
