<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255',Rule::unique(User::class)->ignore($this->user()->id),],
            'email' => ['required','string','email','max:255',Rule::unique(User::class)->ignore($this->user()->id),],
            'about_me' => ['nullable', 'string', 'max:1000'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'username.unique' => __('The username is already taken. Please choose a different one.'),
            'email.unique' => __('The email address is already in use. Please choose a different one.'),
        ];
    }

}
