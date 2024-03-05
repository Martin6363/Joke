<?php

namespace App\Http\Requests\Post;

use App\Rules\TestRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>['required','string','max:255','min:5'],
            'description'=>['required', 'string', 'min:100','max:1500', new TestRule()],
            'user_id' =>['integer'],
            'category_id' =>['integer'],
            'image' =>['max:5120']
        ];
    }
}
