<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Room\RoomRequest;
use App\Http\Resources\Api\Room\RoomResource;
use App\Http\Resources\Api\Room\RoomResourceCollection;
use App\Models\Api\Room\Book;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\Room\Room;
use Illuminate\Support\Facades\Auth;


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

    /**
     * Получить комнату по ID
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function GetRoom($id)
    {
        if (Room::where('id', $id)->exists()) {
            return response()->json([
                'success' => true,
                'room' => new RoomResource(
                    Room::where('id', '=', $id)->first()
                )
            ], 200);
        } else return response()->json(
            [
                'error' => 'this room ' . $id . ' not found'
            ], 404);
    }

    /**
     * Снять бронирование
     * @param RoomRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function Unbook(RoomRequest $request, $id)
    {
        if (!$this->RoomExists($id)) {
            return response()->json(['error' => 'this room not found'], 404);
        }
        if(!Book::where('room_id', $id)->exists()){
            return response()->json(['error' => 'this room already unbooked'], 401);
        }
        $user = Auth::user();
        if (!$user->can('update', Book::where('room_id', $id)->first())) {
            return response()->json(['error' => 'Permisson denied'], 401);
        } else {
            $room = Room::where('id', $id)->first();
            $room->is_book = 0;
            $room->save();
            Book::where('room_id', $id)->first()->delete();
            return response()->json([
                'room_id' => $room->id,
                'unbooked' => true
            ], 200);
        }
    }

    /**
     * Забронировать номер
     * @param RoomRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function Book(RoomRequest $request, $id){
        if (!$this->RoomExists($id)) {
            return response()->json(['error' => 'this room not found'], 404);
        }
        if ($this->RoomIsBooked($id)) {
            return response()->json(['error' => 'Room already booked'], 401);
        }else{
            $user = Auth::user();
            $room = Room::where('id', $id)->first();
            $book = Book::create([
                'user_id' => $user->id,
                'room_id' => $id,
                'arrive_date' => $request->arrive_date
            ]);
            $room->is_book = 1;
            $room->save();
            return response()->json([
                'success' => true,
                $book
            ], 200);
        }
    }

    /**
     * Изменить статус бронирования
     * @param RoomRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateStatus(RoomRequest $request, $id){
        if($this->RoomExists($id) && $this->RoomIsBooked($id)){
            $user = Auth::user();
            if (!$user->can('update', Book::where('room_id', $id)->first())) {
                return response()->json(['error' => 'Permisson denied'], 401);
            }
            $validator = Validator::make($request->all(), [
                'book_status' => 'integer|min:0|max:1',
            ]);
            if(!$validator->fails()) {
                $book = Book::where('room_id', $id)->first();
                $book->book_status = $request->book_status;
                $book->save();
                return response()->json([
                    'success' => true,
                    'udated' => $book
                ], 200);
            }else{
                return response()->json([
                    'error' => 'confirm status invalid'
                ] ,200);
            }
        }else{
            return response()->json( [
                'error' => 'update is filed'
            ], 200);
        }
    }

    /**
     * Изменить дату прибытия
     * @param RoomRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateArriveDate(RoomRequest $request, $id){
        if($this->RoomExists($id) && $this->RoomIsBooked($id)){
            $user = Auth::user();
            if (!$user->can('update', Book::where('room_id', $id)->first())) {
                return response()->json(['error' => 'Permisson denied'], 401);
            }
            $valdate = $request->get('arrive_date');
                $book = Book::where('room_id', $id)->first();
                $book->arrive_date = $request->arrive_date;
                $book->save();
                return response()->json([
                    'success' => true,
                    'udated' => $book
                ], 200);
        }else{
            return response()->json( [
                'error' => 'update is filed'
            ], 200);
        }
    }


    /**
     * Проверить существует ли комната
     * @param $roomId
     * @return bool
     */
    private function RoomExists($roomId){
        return (bool)Room::where('id', $roomId)->exists();
    }

    /**
     * Проверить забронирована ли комната
     * @param $roomId
     * @return bool
     */
    private function RoomIsBooked($roomId){
        return (bool)Room::where('id', $roomId)->first()->is_book;
    }
}
