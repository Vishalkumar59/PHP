<?php
use Illuminate\Support\Facades\Route;
use Modules\Newsletter\Http\Controllers\SenderListController;
use Modules\Newsletter\Http\Controllers\TemplateController;
use Modules\Newsletter\Http\Controllers\TemplateListController;
use Modules\Newsletter\Http\Controllers\ContactGroupController;
use Modules\Newsletter\Http\Controllers\ServerMailController;
use Modules\Newsletter\Http\Controllers\ContactController;
use Modules\Newsletter\Http\Controllers\CampaignController;




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
    // Sender List Resource
    Route::resource('server-mail', ServerMailController::class);
    Route::post('server-update',[ServerMailController::class,'ServerUpdate'])->name('server-update');
    Route::resource('sender-list', SenderListController::class);
    Route::post('sender-update',[SenderListController::class,'SenderUpdate'])->name('sender-update');
    Route::post('sender-status',[SenderListController::class,'ChangeSenderStatus'])->name('sender-status');
    Route::post('server-status',[ServerMailController::class,'ChangeServerStatus'])->name('server-status');

    //campaign Route
    Route::resource('campaign',CampaignController::class);
    Route::post('campaign-status',[CampaignController::class,'ChangeCampaignStatus'])->name('campaign-status');
    Route::post('campaign-update',[CampaignController::class,'CampaignUpdate'])->name('campaign-update');
    Route::post('campaign-view',[CampaignController::class,'CampaignView'])->name('campaign-view');

    // Template Route
    Route::resource('template-group-list', TemplateController::class);
    Route::post('template-status',[TemplateController::class,'ChangeTemplateStatus'])->name('template-status');
    Route::post('template-delete',[TemplateController::class,'TemplateDestroy'])->name('template-delete');
    Route::post('template-update',[TemplateController::class,'TemplateUpdate'])->name('template-update');

    // Template route
     Route::resource('template-list', TemplateListController::class);
     Route::get('template-lists/{id}', [TemplateListController::class,'TemplateList'])->name('TemplateLists');
     Route::post('template-list-status',[TemplateListController::class,'ChangeTemplateListStatus'])->name('template-list-status');
    Route::post('template-list-delete',[TemplateListController::class,'TemplateListDestroy'])->name('template-list-delete');
    Route::post('template-list-update',[TemplateListController::class,'TemplateListUpdate'])->name('template-list-update');

    //contact route
     Route::resource('contact-group-list', ContactGroupController::class);
    
     Route::post('contact-group/changeContactGroupStatus', [ContactGroupController::class,'changeContactGroupStatus'])->name('changeContactGroupStatus');
     Route::post('contact-group/contactGroupUpdate',[ContactGroupController::class,'contactGroupUpdate'])->name('contactGroupUpdate');
     Route::post('deleteContactGroup/{id}', [ContactGroupController::class,'deleteContactGroup'])->name('deleteContactGroup');
     Route::post('contact-view',[ContactGroupController::class,'ContacView'])->name('contact-view');

     

//bulk import
Route::get('importfile',[ContactController::class,'import'])->name('importcreate');
Route::post('import',[ContactController::class,'uploadContactList'])->name('import');
Route::get('simple-download-file',[ContactController::class,'donwloadFile'])->name('simple-download-file');


     //contact list route

    Route::get('contact-list/{id}',[ContactController::class,'GetContact'])->name('get-contact-id');
    Route::get('contact-lists/{id}',[ContactController::class,'GetContactList'])->name('contact-list-show');
    Route::resource('add-contact', ContactController::class);
    Route::get('contact-list/{id}',[ContactController::class,'GetGroupId'])->name('contact-list');
    // Route::get('/contact-list/{id}', [ContactController::class, 'GetContactList']);
    Route::get('checkgroupbox',[ContactController::class,'checkgroupbox'])->name('checkgroupbox');

    Route::post('contact-list/updateContact', [ContactController::class,'updateContact'])->name('updateContact');
    Route::post('contact-list/changeContactListStatus', [ContactController::class,'changeContactListStatus'])->name('changeContactListStatus');
    Route::post('contact-list/ChangeContactToGroupStatus', [ContactController::class,'ChangeContactToGroupStatus'])->name('ChangeContactToGroupStatus');

});

