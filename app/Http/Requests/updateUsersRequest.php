<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
        if ($method == 'PUT') {

            return [
                "nom" => 'required|max:16',
                "prenom" => 'required|max:16',
                "email" => 'required|email',
                "password" => 'required|min:8',
            ];
        } else {
            return [
                "nom" => 'sometimes|required|max:16',
                "prenom" => 'sometimes|required|max:16',
                "email" => 'sometimes|required|email',
                "password" => 'sometimes|required|min:8',
            ];
        }
    }
}
