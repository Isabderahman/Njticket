<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $methode = $this->methode();
        if($methode='PUT'){
            return[
                "Profile" => 'required',
                "entreprise" => 'required',
                "Projet_id" => 'required',
            ];
        }else{
            return[
                "Profile" => 'sometimes|required',
                "entreprise" => 'sometimes|required',
                "Projet_id" => 'sometimes|required',
            ];
        }
    }
}
