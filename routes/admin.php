<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/dashboard', 'DashboardController')
    ->name('admin.dashboard')
    ->middleware('auth');

Route::get('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin', function(){
    return redirect()->route('admin.dashboard');
});

Route::get('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage', function () {
    return redirect()->route('admin.dashboard');
});

// SETTING
Route::patch('changeStatusMaintenance', "SettingController@changeMaintenance");
Route::patch('changeRegisterMember', "SettingController@changeRegisterMember");

//ADS
Route::get('changeStatus', 'AdvertisementController@changeStatus');
Route::get('changeNewsStatus', 'AdvertisementController@changeNewsStatus');
Route::get('changeSubscribeStatus', 'SubscribersController@changeStatus');


// Edition
Route::get('changeEditionStatus', 'LatestEditionController@changeStatus');
Route::get('changeSponsorStatus', 'SponsorVideoController@changeStatus');

// USER
Route::get('getsocmed', 'SocialmediaController@getSocmed');

//AJAX
Route::group(['prefix' => 'ajax', 'middleware' => 'auth'], function () {
    Route::get('categories/search', 'CategoryController@ajaxSearch')->name('categories.search');
    Route::get('tags/search', 'TagController@tagsSearch')->name('tags.search');
    Route::get('roles/search', 'RoleController@ajaxSearch')->name('roles.search');
    Route::get('socialmedia/search', 'SocialmediaController@ajaxSearch')->name('socialmedia.search');
    Route::get('menu/search', 'MenuController@ajaxSearch')->name('menu.search');
    Route::post('magazines/change-status', 'MagazineController@changeStatus')->name('magazines.change-status');
});

Route::get('data/themes', 'ThemeController@theme')->name('theme')->middleware('auth');;

//PROFILE
Route::prefix('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin')->middleware('auth')->group(function () {
    Route::get('avatar/{filename}', function ($filename)
    {
        if(Storage::disk('public')->exists('avatar/' . $filename)){
            return Image::make(storage_path('app/public/avatar/' . $filename))->response();
        }else{
            return Image::make(public_path('img/noavatar.png'))->response();
        }
    })->name('profile.photo');
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::patch('profile/{id}', 'ProfileController@update')->name('profile.update');
    Route::get('change-password', 'ProfileController@change_password');
    Route::post('change-password', 'ProfileController@password_update')->name('password.update');

    Route::resource('magazines', 'MagazineController');
    // Route::get('read-magazine/{magazinId}', 'MagazineController@readMagazine')->name('magazine.read');
    // Route::get('view-news-letter', 'MagazineController@viewNewsLetter')->name('view.news_letter');
    Route::get('send-news-letter', 'MagazineController@sendNewsLetterEmail')
        ->name('mailjet.send-news-letter');
    Route::get('send-magazine-letter', 'MagazineController@sendMagazineLetterEmail')
        ->name('mailjet.send-magazine-letter');
});

// MENU
Route::group(['middleware' => config('menu.middleware')], function () {
    $path = rtrim(config('menu.route_path'));
    Route::post($path .'/addcustommenu', ['as' => 'haddcustommenu', 'uses' => 'MenuController@addcustommenu']);
    Route::post($path .'/deleteitemmenu', ['as' => 'hdeleteitemmenu', 'uses' => 'MenuController@deleteitemmenu']);
    Route::post($path .'/deletemenug', ['as' => 'hdeletemenug', 'uses' => 'MenuController@deletemenug']);
    Route::post($path .'/createnewmenu', ['as' => 'hcreatenewmenu', 'uses' => 'MenuController@createnewmenu']);
    Route::post($path .'/updateitem', ['as' => 'hupdateitem', 'uses' => 'MenuController@updateitem']);
    Route::post($path . '/generatemenucontrol', ['as' => 'hgeneratemenucontrol', 'uses' => 'MenuController@generatemenucontrol']);
});

//ADMIN MANAGE
Route::prefix('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage')->middleware('auth')->group(function () {
    Route::get('users/massdestroy', 'UserController@massdestroy')->name('users.massdestroy');
    Route::get('roles/massdestroy', 'RoleController@massdestroy')->name('roles.massdestroy');
    Route::get('permissions/massdestroy', 'PermissionController@massdestroy')->name('permissions.massdestroy');
    Route::get('socialmedia/massdestroy', 'SocialmediaController@massdestroy')->name('socialmedia.massdestroy');
    Route::get('contacts/massdestroy', 'ContactController@massdestroy')->name('contacts.massdestroy');
    Route::get('ads/massdestroy', 'AdvertisementController@massdestroy')->name('ads.massdestroy');
    Route::get('pages/massdestroy', 'PageController@massdestroy')->name('pages.massdestroy');
    Route::get('posts/massdestroy', 'PostController@massdestroy')->name('posts.massdestroy');
    Route::get('categories/massdestroy', 'CategoryController@massdestroy')->name('categories.massdestroy');
    Route::get('tags/massdestroy', 'TagController@massdestroy')->name('tags.massdestroy');

    Route::patch('themes/activated', 'ThemeController@activated')->name('theme.activated');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('socialmedia', 'SocialmediaController');
    Route::get('settings', 'SettingController@setting')->name('settings.index');
    Route::patch('settings/update', 'SettingController@settingUpdate')->name('settings.update');
    Route::post('env/upload', 'EnvController@upload')->name('upload');
    Route::resource('galleries', 'GalleryController');
    Route::get('filemanager', function () {
        return view('admin.filemanager.index');
    });
    Route::resource('advertisement', 'AdvertisementController');
    Route::resource('newsletter', 'NewslettersController');
    Route::resource('subscriber', 'SubscribersController');
    Route::resource('latest-edition', 'LatestEditionController');
    Route::resource('sponsor-video', 'SponsorVideoController');
    Route::get('menu', 'MenuController@index')->name('menu.index');
    Route::delete('menu/{id}', 'MenuController@destroy')->name('menu.destroy');
    Route::put('menu/{id}', 'MenuController@update')->name('menu.update');
    Route::get('menu/position', 'MenuController@position')->name('menu.position');
    Route::post('menu', 'MenuController@store')->name('menu.store');
    Route::resource('contacts', 'ContactController');
    Route::resource('posts', 'PostController');
    Route::resource('pages', 'PageController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('themes', 'ThemeController');
});
