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
Route::post('/staff/addnewstaff','StaffsController@create');
Route::get('/editstaff/{staff}','StaffsController@edit');
Route::post('/editstaff/update/{staff}','StaffsController@update');
Route::get('/staff/destroy/{staff}','StaffsController@destroy');

Route::get('/pettycash','PettyCashs@index');
Route::post('/pettycash/store','PettyCashs@store');




Route::get('/sponsors','SponsorsController@index');
Route::post('/sponsors/store','SponsorsController@store');
Route::get('/editsponsor/{sponsor}','SponsorsController@edit');
Route::post('/editsponsor/update/{sponsor}','SponsorsController@update');
Route::get('/editsponsor/destroy/{sponsor}','SponsorsController@destroy');

Route::get('/viewsponsor/{sponsor}/view','SponsorsController@show');
Route::get('/viewsponsor/viewfundings/{sponsor}/view','SponsorsController@showfundings');
Route::get('/viewsponsor/viewprojects/{sponsor}/view','SponsorsController@showprojects');
Route::get('/viewsponsor/printsponsorprojects/{sponsor}/print','SponsorsController@printprojects');
Route::get('/viewsponsor/printsponsorfundings/{sponsor}/print','SponsorsController@printfunds');




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


Route::get('/viewproject/editvotehead/{votehead}','VoteheadController@edit');

Route::post('/saveeditedvotehead/{votehead}','VoteheadController@update');

Route::get('/viewproject/deletevotehead/{votehead}','VoteheadController@destroy');



Route::get('/viewproject/deletemilestone/{milestone}','ActivitiesController@destroy');
Route::get('/viewproject/editmilestone/{milestone}','ActivitiesController@edit');
Route::post('/saveupdatedmilestone/{activity}','ActivitiesController@saveupdated');




Route::get('/funds','FundingController@index');
Route::post('/funds/store','FundingController@store');
Route::get('/funds/{fund}/edit','FundingController@edit');
Route::post('/funds/{fund}/update','FundingController@update');
Route::get('/funds/{fund}/destroy','FundingController@destroy');
