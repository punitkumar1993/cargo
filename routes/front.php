<?php
use App\Helpers\Settings;
use App\Models\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

/*Route::get('/foo', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});*/

Route::get('ogi/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('images/' . $filename)) {
        return Image::make(storage_path('app/public/images/' . $filename))->response();
    } else {
        return Image::make(public_path('img/cover.png'))->response();
    }
})->name('ogi.display');

Route::middleware('public')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/latest-news', 'ArticleController@index')->name('articles.latest');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::get('/news/{post:post_name}', 'ArticleController@show')->name('article.show');
    Route::get('/events/{post:post_name}', 'ArticleController@show')->name('event.show');
    Route::get('/mros/{post:post_name}', 'ArticleController@show')->name('mros.show');
    Route::get('/popular/news', 'ArticleController@showPopular')->name('article.popular');
    Route::get('/category/{term:slug}', 'CategoryController@index')->name('category.show');
    Route::get('/news', 'CategoryController@news')->name('news.show');
    Route::get('/events', 'CategoryController@events')->name('events.show');
    Route::get('/mros', 'CategoryController@mro')->name('mro.show');
    Route::get('/tag/{term:slug}', 'TagController@index')->name('tag.show');
    Route::get('/page/{page:post_name}', 'PageController@show')->name('page.show');
    Route::post('/sendcontact', 'ContactController@store')->name('sendcontact');
    Route::post('/sendmagazine', 'ContactController@storeMagazine')->name('sendmagazine');
    Route::patch('/post/react', 'ArticleController@react')->name('sendreact');
    Route::get('list_events','HomeController@getEvents')->name('events.list');
    Route::get('read-magazine/{magazinId}', 'HomeController@readMagazine')->name('magazine.read');
    Route::get('view-news-letter', 'HomeController@viewNewsLetter')->name('view.news_letter');
    Route::get('view-magazine/{magazineName}', 'HomeController@viewMagazine')->name('view.magazine');



//    Route::get('read-magazine/{magazinId}', 'HomeController@readMagazine')->name('magazine.read');
});

if (Schema::hasTable('settings')) {
    if (Settings::get('permalink')) {
        if (Settings::get('permalink') == "%year%/%month%/%day") {
            Route::get('/{year}/{month}/{day}/{post:post_name}', function ($year, $month, $day, $post)  {
                $showpost = Post::whereYear('created_at', '=', $year)
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->whereDay('created_at', '=', $day)
                    ->wherePostName($post)
                    ->firstOrFail();

                return app('App\Http\Controllers\Front\ArticleController')->show($showpost);
            })->name('article.show')->middleware('public');
        } elseif (Settings::get('permalink') == "%year%/%month%") {
            Route::get('/{year}/{month}/{post:post_name}', function ($year, $month, $post)  {
                $showpost = Post::whereYear('created_at', '=', $year)
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->wherePostName($post)
                    ->firstOrFail();

                return app('App\Http\Controllers\Front\ArticleController')->show($showpost);
            })->name('article.show')->middleware('public');
        } else {
            $word = Settings::get('permalink') != 'post_name' ? Settings::get('permalink') : '';
            $uri = $word."/{post:post_name}";
            Route::get($uri, 'ArticleController@show')->name('article.show')->middleware('public');
        }
    }
}
