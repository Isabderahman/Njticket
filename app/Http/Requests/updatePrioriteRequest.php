<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrioriteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method==='PUT'){
            return [
                'id' => 'required',
                'type_priorite' => 'required',
                'created_at' => 'required',
                'updated_at' => 'required'
            ];
        }else{
            return [
                'id' => 'sometimes|required',
                'type_priorite' => 'sometimes|required',
                'created_at' => 'sometimes|required',
                'updated_at' => 'sometimes|required'
            ];
        }
    }
}
