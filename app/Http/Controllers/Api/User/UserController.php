<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserPageRequest;
use App\Http\Resources\Api\User\UserBookResource;
use App\Http\Resources\Api\User\UserResource;
use App\Http\Resources\Api\User\UserResourceCollection;
use App\Models\Api\Room\Book;
use App\Models\User;

class UserController extends Controller
{

    protected $limit = 9;

    public function index(){
        $collection = new UserResourceCollection(
            User::paginate($this->limit)
        );
        return response()->json([$collection], 200);
    }

    public function GetUser(UserPageRequest $request, $id)
    {
        if($this->UserExists($id)){
            return response()->json([
                new UserResource(
                    User::where('id', $id)->first()
                )
            ],200);
        }else{
            return response()->json(['error' => 'user not found'],200);
        }
    }

    public function GetUserBookedRooms(UserPageRequest $request, $id){
        if($this->UserExists($id)){
            $book_data = Book::where('user_id', $id)->paginate($this->limit);
            $rooms = new UserBookResource($book_data);
            return response()->json([
                'rooms' => $rooms
            ],200);
        }else{
            return response()->json(['error' => 'user not found'],200);
        }
    }

    private function UserExists($userId){
        return (bool)User::where('id', $userId)->exists();
    }
}
