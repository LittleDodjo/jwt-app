<?php

namespace App\Http\Requests\Api\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'arrive_date' => 'date_format:Y-m-d|after:today'
        ];
    }
}
