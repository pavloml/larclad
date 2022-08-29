<?php

use App\Http\Controllers\Api\AdminComplainController;
use App\Http\Controllers\Api\AdminUserActivityController;
use App\Http\Controllers\Api\ComplainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PhoneNumberController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/revoke_token', function (Request $request) {
        return [$request->user()->currentAccessToken()->delete()];
    })->name('api.revoke.token');

    Route::get('/count_unread_messages', [MessageController::class, 'countUnreadMessage'])
        ->name('api.messages.count_unread');

    Route::group(['middleware' => 'not.banned'], function () {
        Route::post('/send_message/{post_id}/{thread_id?}', [MessageController::class, 'store'])
            ->where(['post_id' => '[0-9]+', 'thread_id' => '[0-9]+'])->name('api.message.store');
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

        Route::get('/count_unreviewed_complains', [AdminComplainController::class, 'countUnreviewedComplains'])
            ->name('api.complains.unreviewed.count');
       Route::get('/user_activity_log/{id}', AdminUserActivityController::class);
    });
});

Route::post('/complain', [ComplainController::class, 'store'])->name('api.complain.store');

Route::get('/phone_number/{id}', PhoneNumberController::class)
    ->where(['id' => '[0-9]+'])->name('api.number.get');


