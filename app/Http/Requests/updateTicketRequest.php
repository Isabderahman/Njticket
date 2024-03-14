<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
        $methode = $this->method();
        if($methode='PUT'){
            return [
                'titre_ticket'=>'required',
                'contenu'=>'required',
                'projet_id'=>'required',
                'categorie_id'=>'required',
                'priorite_id'=>'required',
                'etat_id'=>'required',
                'type_ticket'=>'required',
                'realisateur_id'=>'required',
                'modificateur_id'=>'required',
                'description_modification'=>'required'
            ];
        }else{
            return [
                'titre_ticket'=>'sometimes|required',
                'contenu'=>'sometimes|required',
                'projet_id'=>'sometimes|required',
                'type_ticket'=>'sometimes|required',
                'categorie_id'=>'sometimes|required',
                'priorite_id'=>'sometimes|required',
                'etat_id'=>'sometimes|required',
                'modificateur_id'=>'required',
                'description_modification'=>'required'
            ];
        }
    }
}
