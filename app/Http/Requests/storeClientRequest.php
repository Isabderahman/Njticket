<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeClientRequest extends FormRequest
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
        return [
            "profile" => 'required',
            "entreprise" => 'required',
            "projet_id" => 'required',
            "user_ID" => 'required',

            "nom" => 'required|max:16',
            "prenom" => 'required|max:16',
            "email" => 'required|email',
            "password" => 'required|min:8',
        ];
    }
}