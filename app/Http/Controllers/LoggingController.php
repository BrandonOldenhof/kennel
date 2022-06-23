<?php

namespace App\Http\Controllers;

use App\Http\Requests\CspPolicyReportToLoggingRequest;
use App\Http\Requests\CspPolicyReportUriLoggingRequest;
use Illuminate\Support\Facades\Log;

class LoggingController extends Controller
{
    public function reportTo(CspPolicyReportToLoggingRequest $request): void
    {
        $validated = $request->safe()->only('reports');

        foreach ($validated['reports'] as $report) {
            $message = "{$report['type']} violation on {$report['url']} reported.";
            Log::channel('audit')->info($message, $report);
        }
    }

    public function reportUri(CspPolicyReportUriLoggingRequest $request): void
    {
        $report = $request->safe();
        $message = "CSP violation on {$report['document-uri']}: request to {$report['blocked-uri']} blocked.";
        Log::channel('audit')->info($message, $report->all());
    }
}
