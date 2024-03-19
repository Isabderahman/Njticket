<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'titre_ticket' => 'required',
            'contenu' => 'required',
            'projet_id' => 'required',
            'categorie_id' => 'required',
            'priorite_id' => 'sometimes|required',
            'etat_id' => 'required',
            'type_ticket' => 'required',
            // 'realisateur_id' => 'required',
        ];
    }
}
