<?php

namespace App\Http\Requests;

use App\Rules\SkillRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:employess,email',
            'date' => 'required|date_format:d/m/Y',
            'address' => 'required',
            'skills' => 'required|array',
            'skillsValues' => ''
        ];
    }

    public function response(array $errors)
    {
        // Always return JSON.
        return response()->json($errors, 422);
    }
}
