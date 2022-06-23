<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $nameRegex = "regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/";

        return [
            'is_admin' => 'required|boolean',
            'name' => "required|{$nameRegex}",
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'notification_type' => 'required|string|in:none,email,sms,push',
            'notification_objects' => 'nullable|array',
            'notification_objects.*' => 'required|string|in:page,post,both',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Naam',
            'password' => 'Wachtwoord',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_admin' => $this->is_admin ?? false,
        ]);
    }
}
