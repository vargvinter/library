<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Country;
use Illuminate\Contracts\Validation\Rule;

class StoreUpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'publish_date' => 'required|date_format:Y-m-d',
            'author_id' => 'required|exists:authors,id',
            'country_id' => [
                'required',
                'array'
            ]
        ];
    }
}
