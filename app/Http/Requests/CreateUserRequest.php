<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            //
            'name' => ['required', 'min:3'],
            'username' => ['required', 'unique:users'],
            'fonction' => ['required', 'integer'],
            'email' => ['required', 'email'],
            'bio' => ['required', 'min:5'],


        ];
    }

    public function name():string{
        return $this->get('name');
    }

    public function username():string{
        return $this->get('username');
    }

    public function fonction():int{
        return (int) $this->get('fonction');
    }

    public function email():string{
        return $this->get('email');
    }

    public function bio():string{
        return $this->get('bio');
    }
}
