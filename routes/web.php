<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\MailCreateController;
use App\Http\Controllers\IncomingMailController;
use App\Http\Controllers\MailEditController;
use App\Http\Controllers\OutgoingMailController;
use App\Http\Controllers\UserController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return redirect(route('dashboard'));
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/mail', MailController::class)->name('mail.request.index');
    Route::get('/mail/create', MailCreateController::class)->name('mail.request.create');

    Route::get('/mail/{mail}/edit', MailEditController::class)->name('mail.request.edit');

    Route::get('/mail/incoming', IncomingMailController::class)->name('mail.incoming');
    Route::get('/mail/incoming/{mail}', function () {
        return Pdf::loadView('mail.incoming.mail')->stream();
    })->name('mail.incoming.generate');

    Route::get('/mail/outgoing', OutgoingMailController::class)->name('mail.outgoing');

    Route::get('/user', UserController::class)->name('user');
});
