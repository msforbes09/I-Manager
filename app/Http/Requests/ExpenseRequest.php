<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'subject' => 'required|min:3',
            'amount' => 'required|numeric',
        ];
    }
}
