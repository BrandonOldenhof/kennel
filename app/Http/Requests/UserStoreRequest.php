<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        $passwordRegex = 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/';
        $nameRegex = "regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/";

        return [
            'is_admin' => 'required|boolean',
            'name' => "required|{$nameRegex}",
            'email' => 'required|email|unique:users,email',
            'password' => "required|min:6|confirmed|${passwordRegex}",
            'notification_type' => 'required|string|in:none,email,sms,push',
            'notification_objects' => 'nullable|array',
            'notification_objects.*' => 'required|string|in:page,post,both',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'naam',
            'password' => 'wachtwoord',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_admin' => $this->is_admin ?? false,
        ]);
    }
}
