


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

Route::get('test123', function() {
    $crawler = Goutte::request('GET', 'http://dantri.com.vn/van-hoa.htm');
    $crawler->filter('a.fon6')->each(function ($node) {
      echo $node->text()."</br>";
    });
    // return view('welcome');
});

  /* STAR DEMO COOKIE*/
  	Route::get('setCookie','MyController@setCookie');
  	Route::get('getCookie','MyController@getCookie');
  	Route::get('uploadFile', function() {
  	    return view('demo.uploadfile');
  	});
  	Route::post('postFile','MyController@postFile')->name('postFile');

  	// JSON
  	Route::get('getJson','MyController@getJson');
  	/* TRUYEN DU LIEU TREN VIEW */
  	Route::get('Time/{t}','MyController@Time');
  	/* DUNG CHUNG */
  	View::share('KhoaHoc','Laravel');

  	Route::get('BladeTemplate/{str}','MyController@blade');
  	Route::get('abc','MyController@abc');

    /* */
    Route::get('lietket', function() {
        $data = App\Category::find(6)->post;
        var_dump($data);
    });

    /* Middleware*/

    Route::get('diem', function() {
        echo "BẠn đã có điểm";
    })->middleware('MyMiddle');
    /*định danh*/

    Route::get('loi', function() {
        echo "ban chưa có điểm";
    })->name('loi');
  /*END DEMO COOKIE*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('abc', function() {
        return view('blog.show');
    })->name('dashboard');
// Route::get('upload', function() {
//     return view('tes')
// });

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('dashboard', function() {
         return view('posts.index');
     });
  Route::get('/posts','PostController@adminIndex')->name('admin.posts.list');
	Route::get('/posts/draft','PostController@adminDraftPosts')->name('admin.posts.draft');
	Route::get('/posts/create','PostController@adminPostCreate')->name('posts.create');
	Route::post('/posts/store','PostController@adminPostStore')->name('posts.store');
	Route::post('/posts/draft','PostController@adminDraftUpt')->name('posts.draft.update');
	Route::get('/posts/edit/{slug}','PostController@adminPostEdit')->name('posts.edit');
	Route::post('/posts/update','PostController@adminPostUpdate')->name('posts.update');
	Route::post('/posts/delete','PostController@adminPostDelete')->name('posts.delete');
	Route::post('/posts/detail',function() {
		return view('posts.list');
	})->name('detail-post');
  
// Route::get('/', function() {
//      return redirect()->route('admin.posts.list');
// });

	Route::get('/categories','Admin\CategoryController@index')->name('categories.index');
  Route::post('/categories/store','Admin\CategoryController@store')->name('category.store');
	Route::get('/categories/show','Admin\CategoryController@show')->name('category.show');
  Route::get('/categories/edit','Admin\CategoryController@edit')->name('category.edit');
	Route::post('/categories/update','Admin\CategoryController@update')->name('category.update');
	Route::post('/categories/delete','Admin\CategoryController@destroy')->name('category.delete');

	Route::get('/tags','Admin\TagController@index')->name('tags.index');
	Route::get('/tags/store','Admin\TagController@store')->name('tags.store');
	Route::get('/tags/edit','Admin\TagController@edit')->name('tags.edit');
	Route::post('/tags/delete','Admin\TagController@destroy')->name('tags.delete');
});
// --------------------------




// ============================================
Route::prefix('admin')->group(function(){
    Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminAuth\LoginController@login')->name('abc');
    Route::post('logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    Route::get('register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'AdminAuth\RegisterController@register');

    // Password Reset Routes...
   Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset');
});

 // =============TEST====================

// Route::get('/redirect/{social}', 'SocialAuthController@redirect');
// Route::get('/callback/{social}', 'SocialAuthController@callback');



Route::get('login/google', 'Auth\GoogleController@redirectToProvider');
Route::get('login/google/callback', 'Auth\GoogleController@handleProviderCallback');

Route::get('login/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');
// =======================================
  Route::get('yes', function() {
      event(new\App\Events\CountView($post));
  });


