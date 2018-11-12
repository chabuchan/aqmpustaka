<?php

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
$FRONTEND = 'aquariuspustakamusik.test';
//$FRONTEND = 'aquariuspustakamusik.com';
$BACKEND  = 'backoffice.aquariuspustakamusik.test';
//$BACKEND  = 'backoffice.aquariuspustakamusik.com';

Route::group(['domain' => $FRONTEND], function () {
//Route::group(['domain' => $FRONTEND,'middleware'=>['under-construction']], function () {
    Route::get('/',                  'FrontController@index');
    Route::get('/home'              ,'FrontController@index'              )->name('front-home');
    Route::get('/about'             ,'FrontController@about'              )->name('front-about');
    Route::get('/contact'           ,'FrontController@contact'            )->name('front-contact');
    Route::get('/contact/submit'    ,'FrontController@contact'            )->name('front-contact-submit');
    Route::post('/contact/submit'   ,'FrontController@contactSubmit'      )->name('front-contact-submit');
    Route::get('/catalog'           ,'FrontController@catalog'            )->name('front-catalog');
    Route::post('/catalog'          ,'FrontController@searchCatalog'      )->name('front-catalog-search');
    Route::get('/catalog/request'   ,'FrontController@catalog'            )->name('front-catalog');
    Route::post('/catalog/request'  ,'FrontController@selectCatalog'      )->name('front-catalog-details');
    Route::get('/catalog/submit'   ,'FrontController@catalog'            )->name('front-catalog');
    Route::post('/catalog/submit'   ,'FrontController@submitCatalog'      )->name('front-catalog-details-submit');
    Route::get('/oursongwriters'    ,'FrontController@songwriters'  )->name('front-songwriters');
    Route::get('/termscondition'    ,'FrontController@terms'        )->name('front-terms');
    Route::get('/news'              ,'FrontController@news'         )->name('front-news');
    Route::get('/news/{path}'       ,'FrontController@news_detail'  )->name('front-newsdetail');
});


// For authenticated users
Route::group(['domain' => $BACKEND, 'middleware' => ['auth'] ], function () {

    Route::get(  '/'          ,'BackendController@index'   )->name('office-dashboard');
    Route::get(  '/notes'     ,'BackendController@index'   )->name('office-dashboard-notes');
    Route::get(  '/logout'    ,'BackendController@logout'  )->name('office-dashboard-logout');

    Route::group(['prefix' => 'master'], function () {
        Route::get( '/'    ,'BackendController@index'   )->name('office-music');
        Route::group(['prefix' => 'album'], function () {
            Route::get   ( '/'              ,'Master\Album\ReadController@index'       )->name('office-albums');
            Route::get   ( '/list'          ,'Master\Album\ReadController@lists'       )->name('office-albums-list');
            Route::get   ( '/new'           ,'Master\Album\CreateController@create'    )->name('office-albums-create');
            Route::post  ( '/new'           ,'Master\Album\CreateController@store'     )->name('office-albums-create-save');
            Route::get   ( '/{id}'          ,'Master\Album\ReadController@show'        )->name('office-albums-view');
            Route::get   ( '/edit/{id}'     ,'Master\Album\UpdateController@edit'      )->name('office-albums-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Album\UpdateController@update'    )->name('office-albums-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Album\DeleteController@destroy'   )->name('office-albums-delete');
        });
        Route::group(['prefix' => 'artists'], function () {
            Route::get   ( '/'              ,'Master\Artist\ReadController@index'       )->name('office-artists');
            Route::get   ( '/list'          ,'Master\Artist\ReadController@lists'       )->name('office-artists-list');
            Route::get   ( '/new'           ,'Master\Artist\CreateController@create'    )->name('office-artists-create');
            Route::post  ( '/new'           ,'Master\Artist\CreateController@store'     )->name('office-artists-create-save');
            Route::get   ( '/{id}'          ,'Master\Artist\ReadController@show'        )->name('office-artists-view');
            Route::get   ( '/edit/{id}'     ,'Master\Artist\UpdateController@edit'      )->name('office-artists-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Artist\UpdateController@update'    )->name('office-artists-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Artist\DeleteController@destroy'   )->name('office-artists-delete');
        });
        Route::group(['prefix' => 'songs'], function () {
            Route::get   ( '/'              ,'Master\Song\ReadController@index'       )->name('office-songs');
            Route::get   ( '/list'          ,'Master\Song\ReadController@lists'       )->name('office-songs-list');
            Route::get   ( '/new'           ,'Master\Song\CreateController@create'    )->name('office-songs-create');
            Route::post  ( '/new'           ,'Master\Song\CreateController@store'     )->name('office-songs-create-save');
            Route::get   ( '/{id}'          ,'Master\Song\ReadController@show'        )->name('office-songs-view');
            Route::get   ( '/edit/{id}'     ,'Master\Song\UpdateController@edit'      )->name('office-songs-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Song\UpdateController@update'    )->name('office-songs-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Song\DeleteController@destroy'   )->name('office-songs-delete');
            Route::get   ( '/search/byTitle','Master\Song\ReadController@searchByName'      )->name('office-songs-searchByName');
        });
        Route::group(['prefix' => 'album-songs'], function () {
            Route::get   ( '/'              ,'Master\AlbumSong\ReadController@index'       )->name('office-album-songs');
            Route::get   ( '/new/{id}'      ,'Master\AlbumSong\CreateController@create'    )->name('office-album-songs-create');
            Route::post  ( '/new/{id}'      ,'Master\AlbumSong\CreateController@store'     )->name('office-album-songs-create-save');
            Route::get   ( '/{id}'          ,'Master\AlbumSong\ReadController@show'        )->name('office-album-songs-view');
            Route::get   ( '/edit/{id}'     ,'Master\AlbumSong\UpdateController@edit'      )->name('office-album-songs-edit');
            Route::post  ( '/edit/{id}'     ,'Master\AlbumSong\UpdateController@update'    )->name('office-album-songs-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\AlbumSong\DeleteController@destroy'   )->name('office-album-songs-delete');
        });
        Route::group(['prefix' => 'genres'], function () {
            Route::get   ( '/'              ,'Master\Genre\ReadController@index'       )->name('office-genres');
            Route::get   ( '/list'          ,'Master\Genre\ReadController@lists'       )->name('office-genres-list');
            Route::get   ( '/new'           ,'Master\Genre\CreateController@create'    )->name('office-genres-create');
            Route::post  ( '/new'           ,'Master\Genre\CreateController@store'     )->name('office-genres-create-save');
            Route::get   ( '/{id}'          ,'Master\Genre\ReadController@show'        )->name('office-genres-view');
            Route::get   ( '/edit/{id}'     ,'Master\Genre\UpdateController@edit'      )->name('office-genres-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Genre\UpdateController@update'    )->name('office-genres-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Genre\DeleteController@destroy'   )->name('office-genres-delete');
        });
        Route::group(['prefix' => 'labels'], function () {
            Route::get   ( '/'              ,'Master\Label\ReadController@index'       )->name('office-labels');
            Route::get   ( '/list'          ,'Master\Label\ReadController@lists'       )->name('office-labels-list');
            Route::get   ( '/new'           ,'Master\Label\CreateController@create'    )->name('office-labels-create');
            Route::post  ( '/new'           ,'Master\Label\CreateController@store'     )->name('office-labels-create-save');
            Route::get   ( '/{id}'          ,'Master\Label\ReadController@show'        )->name('office-labels-view');
            Route::get   ( '/edit/{id}'     ,'Master\Label\UpdateController@edit'      )->name('office-labels-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Label\UpdateController@update'    )->name('office-labels-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Label\DeleteController@destroy'   )->name('office-labels-delete');
        });
        Route::group(['prefix' => 'contracts'], function () {
            Route::get   ( '/'              ,'Master\Contract\ReadController@index'       )->name('office-contracts');
            Route::get   ( '/new'           ,'Master\Contract\CreateController@create'    )->name('office-contracts-create');
            Route::post  ( '/new'           ,'Master\Contract\CreateController@store'     )->name('office-contracts-create-save');
            Route::post  ( '/'              ,'Master\Contract\ReadController@search'      )->name('office-contracts-search');
            Route::get   ( '/{id}'          ,'Master\Contract\ReadController@show'        )->name('office-contracts-view');
            Route::get   ( '/edit/{id}'     ,'Master\Contract\UpdateController@edit'      )->name('office-contracts-edit');
            Route::post  ( '/edit/{id}'     ,'Master\Contract\UpdateController@update'    )->name('office-contracts-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\Contract\DeleteController@destroy'   )->name('office-contracts-delete');
        });
        Route::group(['prefix' => 'interested-party'], function () {
            Route::get   ( '/'              ,'Master\InterestedParty\ReadController@index'       )->name('office-parties');
            Route::get   ( '/list'          ,'Master\InterestedParty\ReadController@lists'       )->name('office-parties-list');
            Route::get   ( '/new'           ,'Master\InterestedParty\CreateController@create'    )->name('office-parties-create');
            Route::post  ( '/new'           ,'Master\InterestedParty\CreateController@store'     )->name('office-parties-create-save');
            Route::post  ( '/'              ,'Master\InterestedParty\ReadController@search'      )->name('office-parties-search');
            Route::get   ( '/{id}'          ,'Master\InterestedParty\ReadController@show'        )->name('office-parties-view');
            Route::get   ( '/edit/{id}'     ,'Master\InterestedParty\UpdateController@edit'      )->name('office-parties-edit');
            Route::post  ( '/edit/{id}'     ,'Master\InterestedParty\UpdateController@update'    )->name('office-parties-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\InterestedParty\DeleteController@destroy'   )->name('office-parties-delete');
            Route::get   ( '/query/all'     ,'Master\InterestedParty\ReadController@getAll'      )->name('office-parties-getAll');
        });
        /*
        Route::group(['prefix' => 'file'], function () {
            Route::post   ( '/{id}'         ,'Master\FileController@add'        )->name('office-file-add');
            Route::post   ( '/delete/{id}'  ,'Master\FileController@delete'     )->name('office-file-delete');
        });
        */
        Route::group(['prefix' => 'files'], function () {
            Route::get   ( '/'                     ,'Master\File\ReadController@index'       )->name('office-files');
            Route::get   ( '/{id}'                 ,'Master\File\ReadController@show'        )->name('office-files-view');
            Route::get   ( '/new/{type}/{id}'      ,'Master\File\CreateController@create'    )->name('office-files-create');
            Route::post  ( '/new'           ,'Master\File\CreateController@store'     )->name('office-files-create-save');
            Route::get   ( '/edit/{id}'     ,'Master\File\UpdateController@edit'      )->name('office-files-edit');
            Route::post  ( '/edit/{id}'     ,'Master\File\UpdateController@update'    )->name('office-files-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\File\DeleteController@destroy'   )->name('office-files-delete');
        });
        Route::group(['prefix' => 'contract-interests'], function () {
            Route::get   ( '/'              ,'Master\ContractInterest\ReadController@index'       )->name('office-contract-interest');
            Route::get   ( '/new/{id}/{cid?}','Master\ContractInterest\CreateController@create'    )->name('office-contract-interest-create');
            Route::post  ( '/new/{id}'      ,'Master\ContractInterest\CreateController@store'     )->name('office-contract-interest-create-save');
            Route::get   ( '/edit/{id}'     ,'Master\ContractInterest\UpdateController@edit'      )->name('office-contract-interest-edit');
            Route::post  ( '/edit/{id}'     ,'Master\ContractInterest\UpdateController@update'    )->name('office-contract-interest-edit-save');
            Route::get   ( '/delete/{id}'   ,'Master\ContractInterest\DeleteController@destroy'   )->name('office-contract-interest-delete');
        });
    });
    Route::group(['prefix' => 'system'], function () {
        Route::get( '/'    ,'BackendController@index'   )->name('office-systems');
        Route::group(['prefix' => 'filetypes'], function () {
            Route::get   ( '/'              ,'System\FileType\ReadController@index'       )->name('office-filetypes');
            Route::get   ( '/new'           ,'System\FileType\CreateController@create'    )->name('office-filetypes-create');
            Route::post  ( '/new'           ,'System\FileType\CreateController@store'     )->name('office-filetypes-create-save');
            Route::get   ( '/{id}'          ,'System\FileType\ReadController@show'        )->name('office-filetypes-view');
            Route::get   ( '/edit/{id}'     ,'System\FileType\UpdateController@edit'      )->name('office-filetypes-edit');
            Route::post  ( '/edit/{id}'     ,'System\FileType\UpdateController@update'    )->name('office-filetypes-edit-save');
            Route::get   ( '/delete/{id}'   ,'System\FileType\DeleteController@destroy'   )->name('office-filetypes-delete');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get   ( '/'              ,'System\User\ReadController@index'      )->name('office-users');
            Route::get   ( '/new'           ,'System\User\CreateController@create'   )->name('office-users-create');
            Route::post  ( '/new'           ,'System\User\CreateController@store'    )->name('office-users-create-save');
            Route::get   ( '/{id}'          ,'System\User\ReadController@show'       )->name('office-users-view');
            Route::get   ( '/edit/{id}'     ,'System\User\UpdateController@edit'     )->name('office-users-edit');
            Route::post  ( '/edit/{id}'     ,'System\User\UpdateController@update'   )->name('office-users-edit-save');
            Route::get   ( '/delete/{id}'   ,'System\User\DeleteController@destroy'  )->name('office-users-delete');
        });
    });
    Route::group(['prefix' => 'site'], function () {
        Route::get( '/'    ,'BackendController@index'   )->name('office-sites');
        Route::group(['prefix' => 'page'], function () {
            Route::get   ( '/'              ,'Blog\PageController@index'     )->name('office-pages');
            Route::get   ( '/new'           ,'Blog\PageController@create'    )->name('office-pages-create');
            Route::post  ( '/new'           ,'Blog\PageController@store'     )->name('office-pages-create-save');
            Route::get   ( '/{id}'          ,'Blog\PageController@show'      )->name('office-pages-view');
            Route::get   ( '/edit/{id}'     ,'Blog\PageController@edit'      )->name('office-pages-edit');
            Route::post  ( '/edit/{id}'     ,'Blog\PageController@update'    )->name('office-pages-edit-save');
            Route::get   ( '/delete/{id}'   ,'Blog\PageController@destroy'   )->name('office-pages-delete');
        });
        Route::group(['prefix' => 'post'], function () {
            Route::get   ( '/'              ,'Blog\PostController@index'     )->name('office-posts');
            Route::get   ( '/new'           ,'Blog\PostController@create'    )->name('office-posts-create');
            Route::post  ( '/new'           ,'Blog\PostController@store'     )->name('office-posts-create-save');
            Route::get   ( '/{id}'          ,'Blog\PostController@show'      )->name('office-posts-view');
            Route::get   ( '/edit/{id}'     ,'Blog\PostController@edit'      )->name('office-posts-edit');
            Route::post  ( '/edit/{id}'     ,'Blog\PostController@update'    )->name('office-posts-edit-save');
            Route::get   ( '/delete/{id}'   ,'Blog\PostController@destroy'   )->name('office-posts-delete');
        });
        Route::group(['prefix' => 'inquiry'], function () {
            Route::get   ( '/'              ,'Blog\InquiryController@index'     )->name('office-inquiries');
            Route::get   ( '/{id}'          ,'Blog\InquiryController@show'      )->name('office-inquiries-view');
            Route::get   ( '/delete/{id}'   ,'Blog\InquiryController@destroy'   )->name('office-inquiries-delete');
        });
        Route::group(['prefix' => 'song-usages'], function () {
            Route::get   ( '/'              ,'Blog\SongUsage\ReadController@index'       )->name('office-song-usages');
            Route::get   ( '/{id}'          ,'Blog\SongUsage\ReadController@show'        )->name('office-song-usages-view');
            Route::get   ( '/new/{type}'    ,'Blog\SongUsage\CreateController@create'    )->name('office-song-usages-create');
            Route::post  ( '/new'           ,'Blog\SongUsage\CreateController@store'     )->name('office-song-usages-create-save');
            Route::get   ( '/edit/{id}'     ,'Blog\SongUsage\UpdateController@edit'      )->name('office-song-usages-edit');
            Route::post  ( '/edit/{id}'     ,'Blog\SongUsage\UpdateController@update'    )->name('office-song-usages-edit-save');
            Route::get   ( '/delete/{id}'   ,'Blog\SongUsage\DeleteController@destroy'   )->name('office-song-usages-delete');
        });
        Route::group(['prefix' => 'admin'], function () {
            Route::get   ( '/'              ,'Admin\Invoice\ReadController@index'     )->name('admin-invoice');
            Route::get   ( '/new'           ,'Admin\Invoice\CreateController@create'   )->name('admin-invoice-create');
            Route::post  ( '/new'           ,'Admin\Invoice\CreateController@store'    )->name('admin-invoice-create-save');
            Route::get   ( '/{id}'          ,'Admin\Invoice\ReadController@show'       )->name('admin-invoice-view');
            Route::get   ( '/edit/{id}'     ,'Admin\Invoice\UpdateController@edit'     )->name('admin-invoice-edit');
            Route::post  ( '/edit/{id}'     ,'Admin\Invoice\UpdateController@update'   )->name('admin-invoice-edit-save');
            Route::get   ( '/delete/{id}'   ,'Admin\Invoice\DeleteController@destroy'  )->name('admin-invoice-delete');
            Route::get   ( '/mail/send'   ,'Admin\Invoice\CreateController@send'  )->name('admin-invoice-mail');
        });
        Route::group(['prefix' => 'composer'], function () {
            Route::get   ( '/'              ,'ComposerController@index'     )->name('office-composer');
        });
    });
});

// For guest access only
Route::group(['domain' => $BACKEND, 'middleware' => ['guest'] ], function () {

    Route::get(  '/login'    ,'BackendController@login'   )->name('office-dashboard-login');
    Route::post( '/login'    ,'BackendController@doLogin'   )->name('office-dashboard-login-submit');
});
