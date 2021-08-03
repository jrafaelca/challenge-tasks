<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'description'            => ['required'],
            'maximum_execution_date' => ['required', 'date'],
            'responsible_id'         => [
                'required',
                'numeric',
                Rule::exists('users', 'id')
            ],
        ];
    }
}
