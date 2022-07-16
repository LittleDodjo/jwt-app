<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Api\Room;
use Illuminate\Support\Facades\Response;

class RoomController extends Controller
{

    protected $limit = 9;

    public function index($page)
    {
        return true;
//        $data = Room::paginate($page * $this->limit);
//        return Response::json($data, 200);
    }
}
