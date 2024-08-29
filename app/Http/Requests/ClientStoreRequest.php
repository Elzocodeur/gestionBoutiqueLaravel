<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{
    public function rules()
{
    return [
        'surnom' => 'nullable|string',
        'telephone' => ['required', 'regex:/^\+221(77|76|78|70)[0-9]{7}$/'],
        'adresse' => 'nullable|string',
        'nom' => 'required_if:create_user,true|string',
        'prenom' => 'required_if:create_user,true|string',
        'login' => 'required_if:create_user,true|email|unique:users,login',
        'password' => 'required_if:create_user,true|string|min:8',
    ];
}

}

