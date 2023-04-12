<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestNDS extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'titre' => 'required|regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\d]{1,50}$/u',
            'auteur' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'date_creation' => 'required|date',
        ];
    
        if($this->getMethod() == 'POST') { // Vérifie si la requête est une création ou une mise à jour
            $rules['pdf'] = 'required|mimetypes:application/pdf';
        } else {
            $rules['pdf'] = 'sometimes|mimetypes:application/pdf';
        }
    
        return $rules;
    }
    public function rulesForEdit()
{
    $titre = str_replace('_', ' ', $this->route('slug'));

    return [
        'titre' => 'required|unique:note_de_services,titre,' . $titre . ',titre',
        'auteur' => 'required',
        'date_creation' => 'required|date',
        'pdf' => 'sometimes|required|mimes:pdf|max:10000'
    ];
}

    
}
