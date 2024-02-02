<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailChimpController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('mailchimp')->group(function () {

    // AUDIANCE
    Route::get('/audiance_list', [MailChimpController::class, 'getAudianceList'])->name('audiance_list');
    Route::post('/audiance', [MailChimpController::class, 'getAudiance'])->name('audiance');
    Route::get('/create_audiance', [MailChimpController::class, 'createAudiance'])->name('create_audiance');
    Route::get('/update_audiance/{list_id}', [MailChimpController::class, 'updateAudiance'])->name('update_audiance');
    Route::get('/delete_audiance/{list_id}', [MailChimpController::class, 'deleteAudiance'])->name('delete_audiance');
    
    // MERGE FIELDS
    Route::get('/add_field/{list_id}', [MailChimpController::class, 'addMergeField']);
    
    // CONTACTS
    Route::post('/add_contact', [MailChimpController::class, 'addContact'])->name('addContact');
    Route::get('/contactStatus/{list_id}/{email}', [MailChimpController::class, 'contactStatus']);
    Route::get('/contact_unsubscribe/{list_id}/{email}', [MailChimpController::class, 'contactUnsubscribe']);
    
});