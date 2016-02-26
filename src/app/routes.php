<?php

Route::get('/', ['as' => 'root', 'uses' => 'Mc388\SimpleCms\App\Controllers\Site\ContentController@index']);

Route::group(['middleware' => 'web'], function () {
    Route::get(
        'media/{image}',
        function ($image = null) {
            $path = storage_path() . '/app/media/' . $image;
            if (file_exists($path)) {
                $file = File::get($path);
                $type = File::mimeType($path);

                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);

                return $response;
            }

            abort(404);
        }
    );

    Route::group(['namespace' => 'Mc388\SimpleCms\App\Controllers\Site'], function () {
        Route::resource(
            'contents',
            'ContentController',
            [
                'only' => ['index', 'show']
            ]
        );
        Route::get('sitemap.xml', 'ContentController@siteMap');
    });

    Route::group(
        [
            'middleware' => 'auth',
            'namespace' => '\Mc388\SimpleCms\App\Controllers\Admin',
            'prefix' => 'manage'
        ],
        function () {
            Route::resource(
                'dashboard',
                'DashboardController',
                [
                    'only' => ['index']
                ]
            );

            // Content
            Route::resource('contents', 'ContentController');
            Route::post(
                'contents/updateHierarchy',
                [
                    'uses' => 'ContentController@updateHierarchy',
                    'as' => 'manage.contents.updateHierarchy'
                ]
            );

            // Media
            Route::resource(
                'media',
                'MediaController',
                [
                    'only' => ['index']
                ]
            );
            Route::post(
                'media/file',
                [
                    'uses' => 'MediaController@uploadFile',
                    'as' => 'manage.media.file.create'
                ]
            );
            Route::delete(
                'media/file',
                [
                    'uses' => 'MediaController@deleteFile',
                    'as' => 'manage.media.file.delete'
                ]
            );
            Route::post(
                'media/folder',
                [
                    'uses' => 'MediaController@createFolder',
                    'as' => 'manage.media.folder.create'
                ]
            );
            Route::delete(
                'media/folder',
                [
                    'uses' => 'MediaController@deleteFolder',
                    'as' => 'manage.media.folder.delete'
                ]
            );

            // Setting
            Route::resource(
                'settings', 'SettingController',
                [
                    'only' => ['edit', 'update']
                ]
            );

            // Contact
            Route::resource(
                'contacts', 'ContactController',
                [
                    'only' => ['edit', 'update']
                ]
            );
        });
});
