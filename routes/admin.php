<?php

//Route::get('/home', function () {
//    $users[] = Auth::user();
//    $users[] = Auth::guard()->user();
//    $users[] = Auth::guard('admin')->user();
//
//    //dd($users);
//
//    return view('admin.home');
//})->name('home');
//

Route::get('home','Admin\HomeController@home');
Route::resource('category','Admin\CategoryController');
Route::resource('user','Admin\UserController');
Route::resource('image_upload','Admin\ImageUploadController');
Route::resource('video_upload','Admin\VideoUploadController');
Route::resource('video_category','Admin\VideoCategoryController');
Route::resource('banner_upload','Admin\BannerUploadController');
Route::resource('slider','Admin\SliderUploadController');
Route::resource('business_category','Admin\BusinessCategoryController');
Route::resource('business_category_image_upload','Admin\BusinessCategoryImageUploadController');
Route::resource('business_video_upload','Admin\BusinessVideoUploadController');
Route::resource('festival_video_upload','Admin\FestivalVideoUploadController');
Route::resource('feedback','Admin\FeedbackController');
Route::resource('business','Admin\BusinessController');
Route::resource('greeting_category','Admin\GreetingCategoryController');
Route::resource('greeting_image','Admin\GreetingImageController');



