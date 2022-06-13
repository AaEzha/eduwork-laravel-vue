<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'member'     => 'required',
            'date_start' => 'required|date',
            'date_end'   => 'required|date|after:date_start',
            'books'      => 'required|array',
            'status'     => ''
        ];
    }
}