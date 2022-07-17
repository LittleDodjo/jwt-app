<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Room\RoomRequest;
use App\Http\Resources\Api\Room\RoomResource;
use App\Http\Resources\Api\Room\RoomResourceCollection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\Room\Room;


class RoomController extends Controller
{

    protected $limit = 9;

    /**
     * Возвращает список всех комнат с пагинацией     *
     * @return mixed
     */
    public function index()
    {
        if (request()->has('book')) {
            $request = request();
            $validator = Validator::make($request->all(), [
                'book' => 'integer|min:0|max:1',
            ]);
            $isBook = request('book');
            if (!$validator->fails()) {
                return response()->json([
                    'sucess' => true,
                    'rooms' => new RoomResourceCollection(
                        Room::where('is_book', $isBook)->paginate($this->limit)
                    )
                ], 200);
            }
        }
        return response()->json(
            [
                'success' => true,
                'rooms' => new RoomResourceCollection(
                    new RoomResource(
                        Room::paginate($this->limit)
                    )
                )
            ], 200);

    }

    public function GetRoom($id){
        if(Room::where('id', $id)->exists()) {
            return response()->json([
                'success' => true,
                'room' => new RoomResource(
                    Room::where('id', $id)->first()
                )
            ], 200);
        }else return response()->json(
            [
                'error' => 'this room '.$id.' not found'
            ], 404);
    }

    public function Unbook(RoomRequest $request, $id){
        return 'test';
    }
}
