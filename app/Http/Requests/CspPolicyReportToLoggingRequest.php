<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CspPolicyReportToLoggingRequest extends FormRequest
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
            'reports' => 'required|array',
            'reports.*.age' => 'required|int',
            'reports.*.body' => 'required|array',
            'reports.*.body.columnNumber' => 'nullable|integer',
            'reports.*.body.lineNumber' => 'nullable|integer',
            'reports.*.body.blockedUrl' => 'nullable|url',
            'reports.*.body.disposition' => 'nullable|in:report,enforce',
            'reports.*.body.effectiveDirective' => 'nullable|string',
            'reports.*.body.originalPolicy' => 'nullable|string',
            'reports.*.body.referrer' => 'nullable|string',
            'reports.*.body.statusCode' => 'nullable|integer',
            'reports.*.body.sourceFile' => 'nullable|url',
            'reports.*.body.policy-id' => 'nullable|url',
            'reports.*.type' => 'nullable|string',
            'reports.*.url' => 'required|url',
            'reports.*.user_agent' => 'required|string',
        ];
    }

    /**
     * We're receiving an array from the Reporting API but we can't validated indexed array, only associative arrays.
     * We have to assign the submitted array to an associative array key.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'reports' => $this->json()->all(),
        ]);
    }
}
