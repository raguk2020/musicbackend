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

    Route::get('getdashboard/', 'DashboardController@getdasboardcount');

    Route::get('journal-year/', 'JournalYearController@getJournalYear');
    Route::post('journal-year/add', 'JournalYearController@addJournalYear');
    Route::get('journal-year/edit', 'JournalYearController@editJournalYear');
    Route::post('journal-year/update', 'JournalYearController@updateJournalYear');
    Route::post('journal-year/status', 'JournalYearController@statusJournalYear');
    Route::post('journal-year/delete', 'JournalYearController@deleteJournalYear');

    Route::get('journal-index/', 'JournalIndexController@getJournalIndex');
    Route::post('journal-index/add', 'JournalIndexController@addJournalIndex');
    Route::get('journal-index/edit', 'JournalIndexController@editJournalIndex');
    Route::post('journal-index/update', 'JournalIndexController@updateJournalIndex');
    Route::post('journal-index/status', 'JournalIndexController@statusJournalIndex');
    Route::post('journal-index/delete', 'JournalIndexController@deleteJournalIndex');
    Route::post('journal-index/fileupload', 'JournalIndexController@fileupload');

    Route::get('catalogue/', 'CatalogueController@getcatalogue');
    Route::post('catalogue/add', 'CatalogueController@addcatalogue');
    Route::get('catalogue/edit', 'CatalogueController@editcatalogue');
    Route::post('catalogue/update', 'CatalogueController@updatecatalogue');
    Route::post('catalogue/status', 'CatalogueController@statuscatalogue');
    Route::post('catalogue/delete', 'CatalogueController@deletecatalogue');

});