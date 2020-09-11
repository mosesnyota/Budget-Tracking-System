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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'MyController@index')->name('home');
Route::get('/test', 'MyController@test')->name('test');

//this creates all the routes for staff

Route::get('/staff','StaffsController@index');
Route::post('/staff/store','StaffsController@store');


Route::get('/pettycash','PettyCashs@index');
Route::post('/pettycash/store','PettyCashs@store');




Route::get('/sponsors','SponsorsController@index');
Route::post('/sponsors/store','SponsorsController@store');





Route::get('/projects','ProjectsController@index');
Route::post('/savenewproject','ProjectsController@store');
Route::post('/editproject/saveupdatedproject/{project}','ProjectsController@update');
Route::get('/editproject/{project}','ProjectsController@edit');
Route::get('/newproject','ProjectsController@create');
Route::get('/viewproject/{project}','ProjectsController@show');

Route::get('/viewproject/editdisbursment/{project}','DisbursmentController@edit');
Route::post('/viewproject/editdisbursment/saveediteddisbursement/{project}','DisbursmentController@update');




Route::post('viewproject/updatevoteheads/{votehead}','VoteheadController@updatevoteheads');


Route::get('/projectreport/{project}','ProjectsController@printreport');

Route::get('/deleteproject/{project}','ProjectsController@destroy');

Route::post('/votehead/store','VoteheadController@store');
Route::post('/disbursment/store','DisbursmentController@store');
Route::post('/disbursment/uploadexcel','DisbursmentController@uploadexcel');


Route::get('/viewproject/disbursment/destroy/{id}','DisbursmentController@destroy')->name('disbursment.destroy');

Route::get('/downloadPDF/{project}','ProjectsController@printPdfReport');
Route::get('/pettycashreport','PettyCashs@printReport');
Route::post('/activity/store','ActivitiesController@store');
Route::post('/activity/update/{activity}','ActivitiesController@update');





