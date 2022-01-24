<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\SenderDetailsController;
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
Route::get('/', [LoginController::class,'showLoginForm'])->name('login');


Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () {  
	return view('pages.forgot-password'); 
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route  
	//Route::get('/dashboard', function () { 
	//	return view('pages.dashboard'); 
	//})->name('dashboard');
	Route::get('/dashboard', [HomeController::class,'dash']);
	



	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});

		//only those have manage_role permission will get access
		Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
			Route::get('/sites', [SitesController::class,'index']);
			Route::post('/site/create', [SitesController::class,'create']);
			Route::get('/site/delete/{id}', [SitesController::class,'delete']);
		});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


});

/*Excel import export*/
Route::get('export', 'ImportExportController@export')->name('export');
Route::get('importExportView', 'ImportExportController@importExportView');
Route::post('import', 'ImportExportController@import')->name('import');
Route::get('sender-details', 'ImportExportController@list');
Route::get('saledata', 'ImportExportController@saledata');
Route::get('purhase-data-request', 'AjaxController@getpurchaseServerSide');
Route::get('list-data', 'ImportExportController@purchasedata');
Route::get('create-new', 'ImportExportController@getpdf');
Route::get('courier-list', 'ImportExportController@bulkpdf');
Route::get('department',  [TableController::class, 'departmentTable']);
Route::get('catagories',  [TableController::class, 'categoryTable']);
Route::get('courier-company',  [TableController::class, 'courierCompanies']);
Route::get('for-company',  [TableController::class, 'forCompany']);


Route::get('/regAdmin', function () { return view('pages.register'); });

Route::any('/save-sender', [SenderDetailsController::class, 'courierCmpy']);

Route::get('/autocomplete-search', [SenderDetailsController::class, 'autocompleteSearch']);

Route::any('/save-newSender', [SenderDetailsController::class, 'newCreate']);

Route::any('delete/{id}', [SenderDetailsController::class, 'destroy']);

Route::get('edit/{id}', [SenderDetailsController::class, 'edit']);

Route::any('edit/update-data/{id}', [SenderDetailsController::class, 'update']);

////
Route::get('edit-department/{id}', [TableController::class, 'editDept']);
Route::put('updated-department', [TableController::class, 'updateDepartment']);
///
Route::get('edit-catagories/{id}', [TableController::class, 'editCat']);
Route::put('update-catagories', [TableController::class, 'updateCatagories']);
////
Route::get('edit-company/{id}', [TableController::class, 'editforCompany']);
Route::put('updated-company', [TableController::class, 'updateforCompany']);
////
Route::get('edit-courierName/{id}', [TableController::class, 'editcourierCompany']);
Route::put('updated-courier', [TableController::class, 'updatecourierCompany']);