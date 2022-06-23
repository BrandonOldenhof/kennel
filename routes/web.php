<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');

Route::resources([
    'users' => UserController::class,
]);

/**
 * Logging routes.
 * These routes are used to log important security events in the application, such as CSP violations.
 * More information about this can be found here:
 *
 * @link https://cheatsheetseries.owasp.org/cheatsheets/Logging_Cheat_Sheet.html
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy#reporting_directives
 */
Route::prefix('logging')
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->group(function () {
        Route::post('/csp/report-to', [LoggingController::class, 'reportTo'])->name('logging.csp.to');
        Route::post('/csp/report-uri', [LoggingController::class, 'reportUri'])->name('logging.csp.uri');
    });
