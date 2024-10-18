<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:task_statuses|max:255'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $errors = $validator->errors();
                if ($errors->has('name') && $errors->first('name') === 'The name has already been taken.') {
                    $errors->forget('name');
                    $errors->add('name', __('Status with the same name already exists'));
                }
            }
        ];
    }
}
