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

Auth::routes();
Route::resource('/all/posts','BlogController');
Route::resource('/registered/users','UserController');
Route::get('publish/post/{blog}','BlogController@publisedPost')->name('post.publisedPost');//تفعييل البوست او لا 
Route::get('/home', 'HomeController@index')->name('home');











Route::get('admin_area', ['middleware' => 'isAdmin', function () {

}]);


/*



Route::get('publish/post/{blog}','HomeController@publisedPost')->name('post.publisedPost');
Route::group(['middleware' => 'isAdmin'], function () {

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/registered/users', 'HomeController@getRegisteredUsers')->name('registered_users');// عرض المستخدمين
Route::get('/registered/users/{users_id}', 'HomeController@edituser')->name('edit_registered_users');//تعديل المسخدم
Route::post('/update/user/{user_id}', 'HomeController@updateuser')->name('update_registered_user');// حفظ البيانات بعد التعديل
Route::post('/delete/user/{user_id}', 'HomeController@deleteuser')->name('delete_user');//حذف مستخدم


Route::get('/all/posts', 'HomeController@PostList')->name('all_posts');// عرض المنشورات
Route::get('/create/post', 'HomeController@createPost')->name('create_post');// عمل منشور
Route::post('/store/post', 'HomeController@storePost')->name('store_new_post');//حفظ منشور
Route::get('/edit/post/{post_id}', 'HomeController@editPost')->name('edit_post_form');//تعديل منشور
Route::post('/update/post/{post_id}', 'HomeController@updatePost')->name('update_post');//حفظ بعد التعديل
Route::post('/delete/post/{post_id}', 'HomeController@deletePost')->name('delete_post');//حذف منشور


}); 


*/