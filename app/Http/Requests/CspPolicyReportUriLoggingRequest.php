<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CspPolicyReportUriLoggingRequest extends FormRequest
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
        return [
            'document-uri' => 'required|url',
            'referrer' => 'nullable|string',
            'violated-directive' => 'required|string',
            'effective-directive' => 'nullable|string',
            'original-policy' => 'nullable|string',
            'blocked-uri' => 'required|url',
            'disposition' => 'nullable|in:report,enforce',
            'status-code' => 'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge($this->json()->get('csp-report'));
    }
}
