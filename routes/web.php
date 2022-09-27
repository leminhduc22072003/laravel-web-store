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


use Carbon\Carbon;

Route::group(['prefix' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('auth.getLogin');
    Route::post('login', 'LoginController@login')->name('auth.postLogin');
    Route::get('logout', 'LoginController@logout')->name('auth.postLogout');

    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('auth.getForgotPassword');
    Route::post('forgot-password', 'ForgotPasswordController@resetPassword')->name('auth.sendMail');

    Route::get('reset-password/{token}', 'ForgotPasswordController@getFormResetPassword')->name('auth.getRecoverPassword');
    Route::post('reset-password/{token}', 'ForgotPasswordController@resetPasswordChange')->name('auth.postRecoverPassword');
});

Route::group(['namespace' => 'Admin', 'middleware' => ['check-admin'], 'prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.list');
        Route::get('/detail', 'UserController@detail')->name('admin.user.detail');
        Route::get('/form', 'UserController@getForm')->name('admin.user.form.get');
        Route::post('/form', 'UserController@saveForm')->name('admin.user.form.post');
        Route::get('/edit/{id}', 'UserController@editForm')->name('admin.user.form.edit');
        Route::post('/update/{id}', 'UserController@updateForm')->name('admin.user.form.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.list');
        Route::get('/form', 'CategoryController@getForm')->name('admin.category.form.get');
        Route::post('/form', 'CategoryController@saveForm')->name('admin.category.form.post');
        Route::get('/edit/{id}', 'CategoryController@editForm')->name('admin.category.form.edit');
        Route::post('/update/{id}', 'CategoryController@updateForm')->name('admin.category.form.update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('admin.product.list');
        Route::get('/form', 'ProductController@getForm')->name('admin.product.form.get');
        Route::post('/form', 'ProductController@saveForm')->name('admin.product.form.post');
        Route::get('/edit/{id}', 'ProductController@editForm')->name('admin.product.form.edit');
        Route::post('/update/{id}', 'ProductController@updateForm')->name('admin.product.form.update');
        Route::get('/delete/{id}', 'ProductController@delete')->name('admin.product.delete');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index')->name('admin.order.list');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('admin.customer.list');
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', 'CouponController@index')->name('admin.coupon.list');
        Route::get('/form', 'CouponController@getForm')->name('admin.coupon.form.get');
        Route::post('/form', 'CouponController@saveForm')->name('admin.coupon.form.post');
        Route::get('/edit/{id}', 'CouponController@editForm')->name('admin.coupon.form.edit');
        Route::post('/update/{id}', 'CouponController@updateForm')->name('admin.coupon.form.update');
        Route::get('/delete/{id}', 'CouponController@delete')->name('admin.coupon.delete');
    });

    Route::group(['prefix' => 'statistical'], function () {
        Route::group(['prefix' => 'showroom'], function () {
            Route::get('/', 'ContactShowroomController@index')->name('admin.statistical.revenue.list');
        });
    });

    Route::group(['prefix' => 'contact'], function () {
        Route::group(['prefix' => 'showroom'], function () {
            Route::get('/', 'ContactShowroomController@index')->name('admin.contact.showroom.list');
            Route::get('/form', 'ContactShowroomController@getForm')->name('admin.contact.showroom.form.get');
            Route::post('/form', 'ContactShowroomController@saveForm')->name('admin.contact.showroom.form.post');
            Route::get('/edit/{id}', 'ContactShowroomController@editForm')->name('admin.contact.showroom.form.edit');
            Route::post('/update/{id}', 'ContactShowroomController@updateForm')->name('admin.contact.showroom.form.update');
            Route::get('/delete/{id}', 'ContactShowroomController@delete')->name('admin.contact.showroom.delete');
        });

        Route::group(['prefix' => 'phone'], function () {
            Route::get('/', 'ContactPhoneController@index')->name('admin.contact.phone.list');
            Route::get('/form', 'ContactPhoneController@getForm')->name('admin.contact.phone.form.get');
            Route::post('/form', 'ContactPhoneController@saveForm')->name('admin.contact.phone.form.post');
            Route::get('/edit/{id}', 'ContactPhoneController@editForm')->name('admin.contact.phone.form.edit');
            Route::post('/update/{id}', 'ContactPhoneController@updateForm')->name('admin.contact.phone.form.update');
            Route::get('/delete/{id}', 'ContactPhoneController@delete')->name('admin.contact.phone.delete');
        });

        Route::group(['prefix' => 'social-network'], function () {
            Route::get('/', 'ContactSocialNetworkController@index')->name('admin.contact.social-network.list');
            Route::get('/form', 'ContactSocialNetworkController@getForm')->name('admin.contact.social-network.form.get');
            Route::post('/form', 'ContactSocialNetworkController@saveForm')->name('admin.contact.social-network.form.post');
            Route::get('/edit/{id}', 'ContactSocialNetworkController@editForm')->name('admin.contact.social-network.form.edit');
            Route::post('/update/{id}', 'ContactSocialNetworkController@updateForm')->name('admin.contact.social-network.form.update');
            Route::get('/delete/{id}', 'ContactSocialNetworkController@delete')->name('admin.contact.social-network.delete');
        });
    });

    Route::get('/ajax-get-category-parent-2', function () {
        $cat_id = \Illuminate\Support\Facades\Input::get('cat_id');

        $categories2 = \App\Models\Category::where('parent_id_1', '=', $cat_id)->get();
        return Response::json($categories2);
    });
});

Route::group(['prefix' => '/ajax'], function () {
    Route::get('/add-cart/{productId}', 'AjaxController@addCart')->name('ajax.add-cart');
    Route::get('/remove-cart/{key}', 'AjaxController@removeCart')->name('ajax.remove-cart');
});

Route::group(['namespace' => 'Client', 'prefix' => '/'], function () {
    Route::get('/', 'ShoppingController@index')->name('client.dashboard');
    Route::get('/tim-kiem', 'ShoppingController@search')->name('client.search');

    Route::get('login', 'UserController@getLogin')->name('client.user.get-login');
    Route::get('logout', 'UserController@logout')->name('client.user.logout');
    Route::post('login', 'UserController@login')->name('client.user.post-login');

    Route::get('register', 'UserController@getRegister')->name('client.user.get-register');
    Route::post('register', 'UserController@register')->name('client.user.post-register');

    Route::get('user/check-order', 'UserController@checkOrder')->name('client.user.check-order');
    Route::get('user/get-detail', 'UserController@getDetail')->name('client.user.detail');
    Route::post('user/change-detail', 'UserController@changeDetail')->name('client.user.change-detail');

    Route::get('cart', 'ShoppingController@cartStep1')->name('client.cart1');
    Route::get('thanhtoan', 'ShoppingController@cartStep2')->name('client.cart2');
    Route::post('thanhtoan/hinh-thuc-thanh-toan', 'ShoppingController@cartStep3')->name('client.cart3');
    Route::get('thanhtoan/hoan-tat', 'ShoppingController@cartStep4')->name('client.cart4');

    Route::get('/{category}', 'ShoppingController@category')->name('client.category');
    Route::get('/{category}/{category1}', 'ShoppingController@category1')->name('client.category1');
    Route::get('/{category}/{category1}/{category2}', 'ShoppingController@category2')->name('client.category2');
    Route::get('/{category}/{category1}/{category2}/{product}', 'ShoppingController@product')->name('client.product');


});
