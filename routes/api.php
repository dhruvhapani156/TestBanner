<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// user Api
Route::post('user/register', 'Api\UserController@register');
Route::post('user/login', 'Api\UserController@login');
Route::post('user/profile', 'Api\UserController@profile');
Route::post('user/user_list', 'Api\UserController@user_list');
Route::post('user/check_otp', 'Api\UserController@check_otp');
Route::post('user/reset_password', 'Api\UserController@reset_password');
Route::post('user/forget_password', 'Api\UserController@forget_password');
Route::post('user/feedback', 'Api\UserController@feedback');
Route::post('user/business_list', 'Api\UserController@business_list');



//Imagecategory api
Route::post('category/category_add', 'Api\CategoryController@category_add');
Route::post('category/category_list', 'Api\CategoryController@category_list');
Route::post('category/category_delete', 'Api\CategoryController@category_delete');
Route::post('category/category_images_add', 'Api\CategoryController@category_images_add');
Route::post('category/category_images_delete', 'Api\CategoryController@category_images_delete');
Route::post('category/about', 'Api\CategoryController@about');
Route::post('category/category_images_list', 'Api\CategoryController@category_images_list');
Route::post('category/company_detail_add', 'Api\CategoryController@company_detail_add');
Route::post('category/festival_video_list', 'Api\CategoryController@festival_video_list');

//VideoCategory api
Route::post('video_category/video_category_add', 'Api\CategoryController@video_category_add');
Route::post('video_category/video_category_list', 'Api\CategoryController@video_category_list');
Route::post('video_category/category_video_add', 'Api\CategoryController@category_video_add');
Route::post('video_category/category_video_list', 'Api\CategoryController@category_video_list');

//Slider api
Route::post('slider/slider_add', 'Api\CategoryController@slider_add');
Route::post('slider/slider_list', 'Api\CategoryController@slider_list');

//business_category api
Route::post('business_category/business_category_list', 'Api\CategoryController@business_category_list');
Route::post('business_category/business_category_images_list', 'Api\CategoryController@business_category_images_list');
Route::post('business_category/business_video_list', 'Api\CategoryController@business_video_list');

//greeting_category api
Route::post('greeting_category/greeting_category_list', 'Api\GreetingController@greeting_category_list');
Route::post('greeting_category/greeting_images_list', 'Api\GreetingController@greeting_images_list');
