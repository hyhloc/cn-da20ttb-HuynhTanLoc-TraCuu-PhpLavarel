<?php
Route::group(['prefix' => 'admin'], function() {
	Route::get('/', 'Admin\AdminController@index')->middleware('auth-admin')->name('admin.dashboard');
    Route::get('/login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Admin\LoginController@login')->name('admin.login.submit');
    Route::get('logout','Admin\LoginController@logout')->name('admin.logout');
    // route cho admin user admin
    Route::group(['prefix' => 'users','middleware'=>'auth-admin'], function() {
        Route::get('change-password','Admin\AdminUserController@changePassword')->name('admin.admin_user.changePassword');
        Route::post('change-password','Admin\AdminUserController@postChangePassword');
    });
    Route::resource('users','Admin\UserController',['middleware'=>'auth-admin']);

    // route cho ajax
    Route::group(['prefix' => 'ajax'], function() {
        Route::post('save-one', 'Admin\Controller@saveOne');
        Route::post('save-all', 'Admin\Controller@saveAll');
    });
    Route::resource('blogs','Admin\BlogController',['middleware'=>'auth-admin']);
    Route::resource('locations','Admin\LocationController',['middleware'=>'auth-admin']);
    Route::resource('foods','Admin\FoodController',['middleware'=>'auth-admin']);
    Route::resource('hotels','Admin\HotelController',['middleware'=>'auth-admin']);
    Route::resource('categories','Admin\CategoriesController',['middleware'=>'auth-admin']);
    
});