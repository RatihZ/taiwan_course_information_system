<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'login','AdminController@login');
     
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::get('logout','AdminController@logout');

        // Display University Table (CRUD - READ)
        Route::get('university','UniversityController@index');
        Route::match(['get','post'],'add-edit-university/{id?}','UniversityController@edit');
        Route::get('delete-university/{id?}','UniversityController@destroy');

        // Display City Table (CRUD - READ)
        Route::get('city','CityController@index');
        Route::match(['get','post'],'add-edit-city/{id?}','CityController@edit');
        Route::get('delete-city/{id?}','CityController@destroy');

        // Display Address Table (CRUD - READ)
        Route::get('address','AddressController@index');
        Route::match(['get','post'],'add-edit-address/{id?}','AddressController@edit');
        Route::get('delete-address/{id?}','AddressController@destroy');

        // Display Department Detail Table (CRUD - READ)
        Route::get('departmentdetail', 'DepartmentdetailController@index');
        Route::match(['get','post'], 'add-edit-departmentdetail/{id?}', 'DepartmentdetailController@edit');
        Route::get('delete-departmentdetail/{id?}','DepartmentdetailController@destroy');

        // Display Laboratory Table (CRUD - READ)
        Route::get('laboratory','LaboratoryController@index');
        Route::match(['get','post'],'add-edit-laboratory/{id?}','LaboratoryController@edit');
        Route::get('delete-laboratory/{id?}','LaboratoryController@destroy');

        // Display Professor Table (CRUD - READ)
        Route::get('professor','ProfessorController@index');
        Route::match(['get','post'],'add-edit-professor/{id?}','ProfessorController@edit');
        Route::get('delete-professor/{id?}','ProfessorController@destroy');

        });
});
    
 