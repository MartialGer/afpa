<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRCS extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'titre' => 'required|regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\d]{1,50}$/u',
        ];
    
        if($this->getMethod() == 'POST') { // Vérifie si la requête est une création ou une mise à jour
            $rules['pdf'] = 'required|mimetypes:application/pdf';
        } else {
            $rules['pdf'] = 'sometimes|mimetypes:application/pdf';
        }
    
        return $rules;
    }
    
}
