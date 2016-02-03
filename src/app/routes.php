<?php

Route::get('/', ['as' => 'root', 'uses' => 'Mc388\SimpleCms\App\Controllers\Site\ContentController@index']);

Route::group(['namespace' => 'Site'], function () {
    Route::resource(
        'contents',
        '\Mc388\SimpleCms\App\Controllers\Site\ContentController',
        ['only' => ['index', 'show']]
    );
    Route::get('sitemap.xml', '\Mc388\SimpleCms\App\Controllers\Site\ContentController@siteMap');
});
