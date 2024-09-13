<?php

namespace App\Http\Requests\Admin\Users;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('sqlsrv.dbo.Account')->ignore($this->user)
            ],
            'username'=> 'required',
            'profile' => [Rule::in(['Administrator','User'])],
            'password' => '',
            'deleted' => [Rule::in(['active','inactive'])],
        ];
    }

    public function updateUser(User $user)
    {
        $user->fill([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'username' => $this->username,
            'profile' => $this->profile,
            'deleted' => $this->deleted
        ]);

        if ($this->password != null) {
            $user->password = $this->password;
        }

        $user->save();

    }
}
