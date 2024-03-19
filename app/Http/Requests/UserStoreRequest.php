<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                'name' => ['required', 'string', 'max:258'],
                'email' => ['required', 'string'],
                'password' => ['required', 'string'],
                'gender' => ['string'],
                'is_blocked' => ['boolean'],
                'is_hide' => ['boolean'],
                'dob' => ['required', 'date'],
                'avatar' => ['string'],
            ];
        } else {
            return [];
        }
    }

    public function messages() {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
                'dob.required' => 'Date Of Birth is required',
            ];
        } else {
            return [];
        }
    }
}
