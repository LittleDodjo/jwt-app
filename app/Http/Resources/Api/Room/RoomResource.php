<?php

namespace App\Http\Resources\Api\Room;

use App\Models\Api\Room\Book;
use App\Models\Api\Room\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{

    public $collects = BookResource::class;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource->is_book) {
            $bookData = new BookResource(
                Book::where('room_id', $this->resource->id)->first()
            );
        } else {
            $bookData = ['unbooked'];
        }
        return [
            'id' => $this->resource->id,
            'room_number' => $this->resource->room_number,
            'room_floor' => $this->resource->room_floor,
            'short_desc' => $this->resource->short_desc,
            'is_book' => $this->resource->is_book,
            'book_data' => [
                $bookData
            ]
        ];
    }
}
