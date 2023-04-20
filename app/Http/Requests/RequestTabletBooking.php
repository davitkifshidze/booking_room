<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestTabletBooking extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => [
                'required',
                'date_format:Y-m-d H:i:s',
                Rule::unique('bookings')->where(function ($query) {
                    return $query->where('room_id', $this->input('room_id'));
                }),
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d H:i:s',
                Rule::unique('bookings')->where(function ($query) {
                    return $query->where('room_id', $this->input('room_id'));
                }),
            ],
        ];
    }
}
