<?php



use App\Helpers\Settings;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;



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

if (Schema::hasTable('settings')) {

    if(Settings::get('register')) {

        if(Settings::get('register') == 'n'){

            Auth::routes(['register'=>false]);

        }else{

            Auth::routes();

        }

    }else{

        Auth::routes(['register'=>false]);

    }

}



Route::get('logo/{filename}', function ($filename)

{

    if(Storage::disk('public')->exists('logo/' . $filename)){

        return Image::make(storage_path('app/public/logo/' . $filename))->response();

    }else{

        return Image::make(public_path('themes/magz/images/logo.png'))->response();

    }

})->name('logo.display');



Route::get('icon/{filename}', function ($filename)

{

    if(Storage::disk('public')->exists('icon/' . $filename)){

        return Image::make(storage_path('app/public/icon/' . $filename))->response();

    }else{

        return Image::make(public_path('favicons/favicon-96x96.png'))->response();

    }

})->name('icon.display');



Route::get('ogi/{filename}', function ($filename)

{

    if(Storage::disk('public')->exists('images/' . $filename)){

        return Image::make(storage_path('app/public/images/' . $filename))->response();

    }else{

        return Image::make(public_path('img/cover.png'))->response();

    }

})->name('ogi.display');



Route::get('ad/{filename}', 'ImageController@displayAdImage')->name('image.AdDisplayImage');
Route::get('edition/{filename}', 'ImageController@displayEditionImage')->name('image.EditionDisplayImage');

Route::get('image/{filename}', 'ImageController@displayImage')->name('image.displayImage');

Route::get('get/post/image/{filename}', 'ImageController@displayPostImage')->name('post.image');

Route::post('image-delete', 'ImageController@removeUploadImage')->name('removeUploadImage');

Route::delete('photo-delete', 'ImageController@removeUserPhoto')->name('user.removePhoto');

Route::post('image-crop', 'ImageController@uploadUserPhoto');



Route::get('search', 'SearchController@search')->name('search');



Route::post('subscribe', 'NewsSubscribeletter@subscribe')->name('subscribe');
Route::get('unsubscribe/{email}', 'NewsSubscribeletter@unSubscribe')->name('unsubscribe.email');

Route::get('send-news-letter', 'NewsSubscribeletter@sendEmailToNewsSubscriber')->name('send-news-letter');
Route::get('magazine', 'NewsSubscribeletter@magzine')->name('magazine');
Route::get('magazine/login', function () {
    return redirect()->route('login');
})->name('magazine.login');

// Default magazine login URI
Route::get('view-magazines', function () {
    $getSettings = Setting::where('name', 'Default Magazine')->get();
    $defaultMagazine = $getSettings->first()->value;
    if ($defaultMagazine == 1) {
        $user = User::where('default', 1)->get()->first();
        if (!is_null($user)) {
            Auth::loginUsingId($user->id);
            return redirect()->route('magazines.index');
        }
    }
    return redirect('/');
})->name('magazine.default-view');

Route::middleware('optimizeImages')->group(function () {

    Route::patch('image-crop', 'ImageController@uploadUserPhoto');

    Route::post('upload-image', 'ImageController@uploadImagePost')->name('uploadImage');

    Route::post('upload-image-ad', 'ImageController@uploadImageAd')->name('uploadImageAd');

    Route::post('resizeImagePost', 'ImageController@resizeImagePost')->name('resizeImagePost');

});



Route::get('photo-author/{filename}', function ($filename){

    return Image::make(storage_path('app/public/avatar/' . $filename))->response();

})->name('author.photo');


Route::get('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/login', 'Auth\LoginController@showLoginFormNew')->name('login');

