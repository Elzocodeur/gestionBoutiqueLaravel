<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'surnom' => 'nullable|string',
            'telephone' => ['required', 'regex:/^\+221(77|76|78|70)[0-9]{7}$/'],
            'adresse' => 'nullable|string',
        ];
    }
}

