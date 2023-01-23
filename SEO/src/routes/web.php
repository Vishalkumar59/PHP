<?php

use Illuminate\Support\Facades\Route;

use Modules\SEO\Http\Controllers\SeoDailyWorkController;
use Modules\SEO\Http\Controllers\SeoTaskController;
use Modules\SEO\Http\Controllers\SeoWebsiteResultController;
use Modules\SEO\Http\Controllers\SeoResultController;  
use Modules\SEO\Http\Controllers\SeoWebsiteController;
use Modules\SEO\Http\Controllers\SeoWorkReportController;
use Modules\SEO\Http\Controllers\SubmissionController;


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




// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => 'auth'], function () {

   
    Route::get('/cache-clear', function() {

        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
       return 'Routes cache cleared';
   });
   
    Route::resource('daily-work', SeoDailyWorkController::class);
    Route::post('work-report-update/{id}', [SeoDailyWorkController::class, 'work_report_update'])->name('work-report-update');
    Route::post('dailyWorkStatus', [SeoDailyWorkController::class, 'dailyWorkStatus'])->name('dailyWorkStatus');
    

    Route::get('/seo-setting', [SeoWorkReportController::class, 'workReport'])->name('workReport');

    Route::post('submission-status',[SubmissionController::class, 'ChangeSubmissionStatus'])->name('submission-status-chenge');

 
    Route::resource('seo-work', SeoWorkReportController::class);
    Route::get('import-data', [SeoWorkReportController::class, 'importData'])->name('work-report.import');
    Route::post('workReportUrl', [SeoWorkReportController::class, 'workReportUrl'])->name('work-report-url');
    Route::post('work-report/import', [SeoWorkReportController::class, 'importStore'])->name('work-report.import.store');

    Route::resource('seo-task', SeoTaskController::class);
    Route::post('seo-task/changeTaskStatus', [SeoTaskController::class,'changeTaskStatus'])->name('changeTaskStatus');

    Route::post('child-delete/{id}', [SeoResultController::class, 'ChildDelete'])->name('child-delete');
    Route::resource('seo-results-data', SeoResultController::class);
    Route::post('seo-results-update', [SeoResultController::class,'resultUpdate'])->name('seo-results-update');
    Route::post('dropdown', [SeoResultController::class,'addDropdown'])->name('dropdown');
    Route::post('changeResultStatus', [SeoResultController::class,'changeResultStatus'])->name('changeResultStatus');

    
    Route::resource('seo-website', SeoWebsiteController::class);
    Route::post('seo-website/changeWebsiteStatus', [SeoWebsiteController::class,'changeWebsiteStatus'])->name('changeWebsiteStatus');

    Route::resource('seo-result', SeoWebsiteResultController::class);
    Route::post('getMonthlyResult', [SeoWebsiteResultController::class, 'getMonthlyResult'])->name('get-monthly-result');

    Route::post('store', [SeoWebsiteResultController::class, 'store'])->name('save-website-update');

    Route::resource('submission', SubmissionController::class);
    Route::post('getsubmissionurl',[SubmissionController::class,'getsubmissionurl'])->name('get-subission-url');
});

