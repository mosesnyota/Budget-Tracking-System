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
Route::get('/staff/{staff}/view','StaffsController@show');




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
Route::get('/viewproject/editproject/{project}/edit','ProjectsController@edit');
Route::get('/newproject','ProjectsController@create');
Route::get('/viewproject/{project}','ProjectsController@show');

Route::get('/viewproject/editdisbursment/{project}','DisbursmentController@edit');
Route::post('/viewproject/editdisbursment/saveediteddisbursement/{project}','DisbursmentController@update');




Route::post('viewproject/updatevoteheads/{votehead}','VoteheadController@updatevoteheads');


Route::get('/viewproject/projectreport/{project}/download','ProjectsController@printreport');

Route::get('/viewproject/deleteproject/{project}/delete','ProjectsController@destroy');

Route::post('/votehead/store','VoteheadController@store');
Route::post('/disbursment/store','DisbursmentController@store');
Route::post('/disbursment/uploadexcel','DisbursmentController@uploadexcel');


Route::get('/viewproject/disbursment/destroy/{id}','DisbursmentController@destroy')->name('disbursment.destroy');

Route::get('/viewproject/downloadPDF/{project}/download','ProjectsController@printPdfReport');

Route::get('/viewproject/downloadExcel/{project}/download','ProjectsController@printExcel');

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
Route::get('/funds/report/{start}/{end}','FundingController@report');
Route::post('/funds/report1','FundingController@report1');




Route::get('/pettycash/{petty}/destroy','PettyCashs@destroy');
Route::get('/pettycash/{petty}/edit','PettyCashs@edit');
Route::post('/pettycash/report1','PettyCashs@report1');
Route::post('/pettycash/report2','PettyCashs@report2');
Route::get('/pettycash/pettycashreport/{start}/{end}','PettyCashs@printReport');
Route::get('/pettycash/pettycashsummaryreport/{start}/{end}','PettyCashs@opensummaryreport');

Route::get('pettycash/pettycashreceiptprint/{petty}/print','PettyCashs@printPettyReceipt');
Route::get('pettycash/reprintreceipt/{petty}/print','PettyCashs@reprintReceipt');
Route::post('/pettycash/{petty}/update','PettyCashs@update');
Route::get('/pettycash','PettyCashs@index');
Route::post('/pettycash/store','PettyCashs@store');


Route::get('/expense','ExpensesController@index');
Route::post('/expense/store','ExpensesController@store');
Route::get('/expense/{fund}/edit','ExpensesController@edit');
Route::post('/expense/{fund}/update','ExpensesController@update');
Route::get('/expense/{fund}/destroy','ExpensesController@destroy');
Route::get('/expense/report/{start}/{end}','ExpensesController@report');
Route::post('/expense/report1','ExpensesController@report1');


Route::get('/viewproject/comment/{project}/edit','ProjectsController@comment');
Route::post('/viewproject/comment/{project}/save','ProjectsController@savecomment');


Route::get('/expenseanalytics','AnalyticsController@index');


Route::get('/suppliers','SupplierController@index');
Route::get('/suppliers/{supplier}/edit','SupplierController@edit');
Route::post('/suppliers/store','SupplierController@store');
Route::get('/editsupplier/{supplier}','SupplierController@edit');
Route::post('/editsupplier/update/{supplier}','SupplierController@update');
Route::get('/supplier/destroy/{supplier}','SupplierController@destroy');
Route::get('/viewsupplier/{supplier}/view','SupplierController@show');
Route::get('/viewsupplier/viewbills/{supplier}/view','SupplierController@viewBills');




Route::get('/bills','BillsController@index');


Route::get('/roles','RolesController@index');
Route::post('/roles/store','RolesController@store');
Route::get('/permissions','RolesController@permissions');
Route::post('/permissions/store','RolesController@storepermission');

Route::get('/roles/{role}/permissions','RolesController@assignpermissions');
Route::POST('roles/savepermissions/{role}','RolesController@savepermissions');


Route::get('/roles/{role}/permissions','RolesController@assignpermissions');

Route::get('/viewproject/budgetstatement/{project}/statement','ProjectsController@budgetstatement');

Route::post('/budget/store/{project}','ProjectsController@updatebudget');
Route::get('/viewproject/export/{votehead}','DisbursmentController@exportDisbursementVotehead');


Route::get('/pettycash/pushtoproject/{transaction}/push','PettyCashs@pushtoproject');
Route::post('/pettycash/pushtransaction/{transaction}/push','PettyCashs@savepushedtransaction');


Route::get('/viewproject/setexchagerate/{project}/currency','ProjectsController@setExchangeRate');
Route::get('/viewproject/setcurrency/{project}/currency','ProjectsController@setCurrency');

Route::post('/password/change','ChangePasswordController@store');

Route::get('/projectsPDF','ProjectsController@projectsPDF');
Route::get('/openprojectreport','ProjectsController@openprojectreport');

Route::post('/getmsg','ProjectsController@getmsg');
Route::get('/updatemyvote?/{disbursment_id}/{votehead_id}','ProjectsController@updatemyvote');
Route::get('/viewproject/updatemyvote?/{disbursment_id}/{votehead_id}','ProjectsController@updatemyvote');