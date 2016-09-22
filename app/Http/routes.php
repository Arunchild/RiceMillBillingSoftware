<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'BillingController@create');

Route::get('home', 'BillingController@create');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Company
Route::resource('company', 'CompanyDetailsController');

//Product Master
Route::resource('ProductMaster', 'ProductMasterController');
Route::resource('ProductMasterKurunai', 'ProductMasterKurunaiController');
Route::resource('ProductMasterOthers', 'ProductMasterOthersController');


//Billing
Route::post('Billing/getstock', 'BillingController@getstock');
Route::post('BillingKurunai/getstock', 'BillingKurunaiController@getstock');
Route::post('BillingOthers/getstock', 'BillingOthersController@getstock');
Route::resource('Billing', 'BillingController');
Route::resource('BillingKurunai', 'BillingKurunaiController');
Route::resource('BillingOthers', 'BillingOthersController');

Route::group(['middleware' => 'auth'], function() {

	Route::resource('Purchase', 'PurchaseController',
		['only' => ['edit', 'update']]);
	Route::resource('PurchaseKurunai', 'PurchaseKurunaiController',
			['only' => ['edit', 'update']]);
	Route::resource('PurchaseOthers', 'PurchaseOthersController',
		['only' => ['edit', 'update']]);

	Route::resource('PurchaseFinal', 'PurchaseFinalController',
		['only' => ['destroy']]);
	Route::resource('PurchaseFinalKurunai', 'PurchaseFinalKurunaiController',
			['only' => ['destroy']]);
	Route::resource('PurchaseFinalOthers', 'PurchaseFinalOthersController',
		['only' => ['destroy']]);

});

//Purchase
Route::resource('Purchase', 'PurchaseController',
	['except' => ['edit', 'update']]);
Route::resource('PurchaseKurunai', 'PurchaseKurunaiController',
		['except' => ['edit', 'update']]);
Route::resource('PurchaseOthers', 'PurchaseOthersController',
	['except' => ['edit', 'update']]);

//Purchase Final
Route::resource('PurchaseFinal', 'PurchaseFinalController',
	['except' => ['destroy']]);
Route::resource('PurchaseFinalKurunai', 'PurchaseFinalKurunaiController',
		['except' => ['destroy']]);
Route::resource('PurchaseFinalOthers', 'PurchaseFinalOthersController',
	['except' => ['destroy']]);


//Billing Final
Route::post('BillingFinal/bill_print', 'BillingFinalController@bill_print');
Route::resource('BillingFinal', 'BillingFinalController');
Route::post('BillingFinalKurunai/bill_print_kurunai', 'BillingFinalKurunaiController@bill_print_kurunai');
Route::resource('BillingFinalKurunai', 'BillingFinalKurunaiController');
Route::post('BillingFinalOthers/bill_print_others', 'BillingFinalOthersController@bill_print_others');
Route::resource('BillingFinalOthers', 'BillingFinalOthersController');

//Reports

Route::post('Reports/reportbydate', 'ReportsController@reportbydate');
Route::post('ReportsKurunai/reportbydate', 'ReportsKurunaiController@reportbydate');
Route::post('ReportsOthers/reportbydate', 'ReportsOthersController@reportbydate');
Route::post('Reports/reportbydateprint', 'ReportsController@reportbydateprint');
Route::post('ReportsKurunai/reportbydateprint', 'ReportsKurunaiController@reportbydateprint');
Route::post('ReportsOthers/reportbydateprint', 'ReportsOthersController@reportbydateprint');
Route::post('Reports/ShowReports', 'ReportsController@ShowReports');
Route::post('ReportsKurunai/ShowReports', 'ReportsKurunaiController@ShowReports');
Route::post('ReportsOthers/ShowReports', 'ReportsOthersController@ShowReports');
Route::resource('Reports', 'ReportsController');
Route::resource('ReportsKurunai', 'ReportsKurunaiController');
Route::resource('ReportsOthers', 'ReportsOthersController');

//Stock

Route::post('Stock/stockbydate', 'StockController@stockbydate');
Route::post('StockKurunai/stockbydate', 'StockKurunaiController@stockbydate');
Route::post('StockOthers/stockbydate', 'StockOthersController@stockbydate');
Route::post('Stock/stockbydateprint', 'StockController@stockbydateprint');
Route::post('StockKurunai/stockbydateprint', 'StockKurunaiController@stockbydateprint');
Route::post('StockOthers/stockbydateprint', 'StockOthersController@stockbydateprint');
Route::resource('Stock', 'StockController');
Route::resource('StockKurunai', 'StockKurunaiController');
Route::resource('StockOthers', 'StockOthersController');

//Settings
Route::resource('Settings', 'SettingsController');
