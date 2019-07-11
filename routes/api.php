<?php

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('journal-index/add', 'BackendController@addjurnalIndex');


    Route::get('journal-year/', 'JournalYearController@getJournalYear');
    Route::post('journal-year/add', 'JournalYearController@addJournalYear');
    Route::get('journal-year/edit', 'JournalYearController@editJournalYear');
    Route::post('journal-year/update', 'JournalYearController@updateJournalYear');
    Route::post('journal-year/status', 'JournalYearController@statusJournalYear');
    Route::post('journal-year/delete', 'JournalYearController@deleteJournalYear');
});