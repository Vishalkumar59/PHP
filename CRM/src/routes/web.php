<?php
use Illuminate\Support\Facades\Route;
use Modules\CRM\Http\Controllers\LeadController;
use Modules\CRM\Http\Controllers\LeadSettingController;
use Modules\CRM\Http\Controllers\QuotationController;
use Modules\CRM\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your aaplication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    //Route::resource('lead-section', LeadController::class);
    Route::resource('leads', LeadController::class);
    Route::post('lead/remove', [LeadController::class,'addmoredelete'])->name('remove');
    Route::post('lead-followup', [LeadController::class,'followStatus'])->name('lead-followup');


    // Route::resource('custom-form', CustomFormController::class);

    // Route::get('changeStatus', [CustomFormController::class, 'changeStatus'])->name('change-status');
    Route::resource('customer', CustomerController::class);
    //Route::get('customer/remove', [CustomerController::class,'aapendDelete']);
  
    // lead seting route
    Route::resource('lead-setting', LeadSettingController::class);
    Route::controller(LeadSettingController::class)->group(function () {
    Route::post('lead-setting-store-status','storeStatus')->name('lead-setting-store-status');
    Route::post('lead-setting-store-industry','storeIndustry')->name('lead-setting-store-industry');
    Route::post('lead-setting-update','LeadSourceUpdate')->name('lead-setting-update');
    Route::post('lead-setting-source','changesourceStatus')->name('lead-setting-source');
    Route::post('lead-setting-update-status','LeadStatusUpdate')->name('lead-setting-update-status');
    Route::post('lead-setting-status','changeStatus')->name('lead-setting-status');
    Route::post('lead-setting-update-industry','LeadIndustryUpdate')->name('lead-setting-update-industry');
    Route::post('lead-setting-industry','changeIndustryStatus')->name('lead-setting-industry');
    });

    // quotation raute
    Route::resource('quotation', QuotationController::class);
    Route::post('quotation-delete', [QuotationController::class,'DeleteQuotation'])->name('quotation-delete');

});


