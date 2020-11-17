<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/visits/{visit_id}/restore', 'VisitController@restore')->name('visits.restore');
Route::resource('visits', 'VisitController');


Route::post('/visitors/{visitor_id}/restore', 'restoreVisitor')->name('visitors.restore')->middleware('role:admin');;
Route::delete('/visitors/{visitor}', 'deleteVisitor')->name('visitors.destroy')->middleware('role:admin');;


Route::post('/department/employees', 'getDepartmentEmployees')->name('department.employees');
Route::post('/departments', 'createDepartment')->name('department.store')->middleware('role:admin');
Route::post('/employees', 'createEmployee')->name('employee.store')->middleware('role:admin');
