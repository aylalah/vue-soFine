<?php
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'api',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');

    
});
 Route::post('me','AuthController@updateprofile');
// Route::get('profile', 'AuthController@profile');
 Route::post('addtype','AddtypeController@store');
  Route::get('gettype','AddtypeController@index');
  
   Route::post('categories','CategoriesController@store');
 Route::get('test',function(){
     return response()->json([
         'user'=>['fname'=>'tawa',
         'lname'=>'adio']
     ]); 
 });
