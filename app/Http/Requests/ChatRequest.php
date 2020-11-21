<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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

    /*public function messages()
    {
        return [
            'date.required' => 'A date is required',
            'date.date_format'  => 'A date must be in format: Y-m-d',
            'date.unique'  => 'This date is already taken',
            'date.after_or_equal'  => 'A date must be after or equal today',
            'date.exists'  => 'This date doesn\'t exists',
        ];
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulesPost = [
            'roomId' => 'required|integer|exists:rooms,id',
            'message' => 'required|string|min:1|max:255',
        ];

        $rulesDelete = [
            //'roomId' => 'required|unique:rooms', // проверять только на пренадлежность пользователю
            'messageId' => 'required|exists:games',
        ];


        switch ($this->getMethod())
        {
            case 'POST':
                return $rulesPost;
            case 'DELETE':
                return $rulesDelete;
        }
    }
}
