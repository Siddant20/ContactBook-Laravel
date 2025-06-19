<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('contacts')->where(function($query){
                return $query->where('user_id',auth()->id());

            }),
        ],
            'phone_number' => 'nullable|string|max:20',
            'address'=> 'nullable|string|max:255',
    ];
    }
    public function messages(){
        return[
            'name.required'=>'Name is required',
            'email.required'=>'email is required',
            'phone.max'=>'phone number is max 20 characters',

        ];
    }
}
