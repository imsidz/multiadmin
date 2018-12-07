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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    
    Route::get('/', [
    	'uses'	=>	'AdminController@index',
    	'as'	=>	'admin.index'
    ])->middleware('permission:see admin');

    Route::get('role', [
    	'uses'	=>	'PermissionController@roleindex',
    	'as'	=>	'role.index'
    ])->middleware('permission:see roles');

    Route::post('role', [
    	'uses'	=>	'PermissionController@rolepost',
    	'as'	=>	'role.post'
    ])->middleware('permission:add roles');

    Route::put('role/{id}', [
    	'uses'	=>	'PermissionController@roleedit',
    	'as'	=>	'role.edit'
    ])->middleware('permission:edit roles');

    Route::delete('role/{id}', [
    	'uses'	=>	'PermissionController@roledelete',
    	'as'	=>	'role.delete'
    ])->middleware('permission:delete roles');

    Route::post('permission/{roleid}', [
        'uses'  =>  'PermissionController@addPermissionToRole',
        'as'    =>  'permission.post'
    ]);

});


Route::get('/home', 'HomeController@index')->name('home');
