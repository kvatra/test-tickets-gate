<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservePlacesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer_name' => 'string|required',
            'places' => 'array|required',
            'places.*' => 'integer',
        ];
    }
}
