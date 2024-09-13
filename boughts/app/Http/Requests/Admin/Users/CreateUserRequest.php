<?php

namespace App\Http\Requests\Admin\Users;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            'username' => ['required', 'unique:sqlsrv.dbo.Account'],
            'email' => ['required','string','Email', 'max:255', 'unique:sqlsrv.dbo.Account'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'profile' =>  Rule::in(['Administrator','User']),
        ];
    }

}
