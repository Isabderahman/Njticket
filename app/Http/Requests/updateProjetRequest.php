<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProjetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Update this to true if you want to allow the request
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
                'nom_projet' => 'required',
            ];
        } else {
            return [
                'nom_projet' => 'sometimes|required',
            ];
        }
    }
}
