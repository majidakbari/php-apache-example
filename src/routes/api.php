<?php

Route::group(['namespace' => 'Asset', 'prefix' => 'asset', 'as' => 'asset.'], function (){
    Route::get('/', 'ListAssetsAction')->name('index');
});
