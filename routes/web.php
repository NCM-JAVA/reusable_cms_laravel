<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as login;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\User_roleController;
use App\Http\Controllers\Admin\AjaxRequestController;
use App\Http\Controllers\Admin\MenuController as menu;
use App\Http\Controllers\Admin\BannerController as banner;
use App\Http\Controllers\Admin\TenderController as tender;
use App\Http\Controllers\Admin\CorrigendumController;
use App\Http\Controllers\Admin\WhatsnewsController as whatsnews;
use App\Http\Controllers\Admin\ModuleController as module;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\VideogalleryController;
use App\Http\Controllers\Themes\HomeController as themes;
use App\Http\Controllers\Themes\InnerPagesController as innerpages ;
use App\Http\Controllers\HomeController  as dashboad; 
use App\Http\Controllers\Admin\GalleryController as gallery;
use App\Http\Controllers\Lang\LangController as lang;
use App\Http\Controllers\Admin\RecruitmentController as recruitment;
use App\Http\Controllers\Admin\LogoController as logo;
use App\Http\Controllers\Admin\OfficerMessageController as officers; 
use App\Http\Controllers\Admin\NotificationsController as notifications; 
use App\Http\Controllers\Admin\TitleController as title;
use App\Http\Controllers\Admin\SocialMediaController as socialMedia;
use App\Http\Controllers\Admin\ConfigurationController as Configuration;
use App\Http\Controllers\Admin\FeedbackController as Feedback;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\PodcastController as Podcast;
use App\Http\Controllers\Admin\MinistersInfoController;
use App\Http\Controllers\Admin\PressReleaseController;
use App\Http\Controllers\Admin\GuidelinesController;
use App\Http\Controllers\Admin\ConsumerProductController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\AdminApprovalController;
use App\Http\Controllers\Admin\SuccessStoryController;


use Illuminate\Http\Response;

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
Route::group(['middleware' => ['XSS']], function () {
       
        
        Route::get('/', [themes::class, 'index']);
        Route::any('pages/{slug}', [innerpages::class, 'index']);
        Route::any('officers/{slug}', [innerpages::class, 'officers']);
        Route::any('tenderivew/{slug}', [innerpages::class, 'tenderivew']);
        Route::get('lang/change', [lang::class, 'change'])->name('changeLang');
        Route::get('/admin/login', function () {return view('auth/login');  });
});

Auth::routes();
Auth::routes(['register' => false]);
Route::get('/register', function () {
        abort(404);
    });
    
Route::group(['middleware' => ['auth','admin','inactivityTimeout']], function () {
        Route::resource('/admin/user', UserController::class);
        Route::resource('/admin/setting', WebsiteSettingController::class);
        Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::any('/admin/store', [UserController::class, 'store'])->name('/admin/user');
        Route::any('/admin/update', [UserController::class, 'update'])->name('/admin/user');
        Route::resource('/admin/user_role', User_roleController::class);
        Route::post('/admin/user_role/{$admin_role}', [User_roleController::class, 'destroy'])->name('admin_role');
        Route::resource('/admin/menu', menu::class);
        Route::resource('/admin/banner', banner::class);
        Route::resource('/admin/tender', tender::class);
		Route::get('/admin/corrigendum/add/{id}/{type}', [CorrigendumController::class, 'create'])->name('corrigendum.add');
        Route::post('/admin/corrigendum/store', [CorrigendumController::class, 'store'])->name('corrigendum.store');
        Route::get('/admin/corrigendum/edit/{id}/{type}', [CorrigendumController::class, 'edit'])->name('corrigendum.edit');
        Route::post('/admin/corrigendum/update/{id}', [CorrigendumController::class, 'update'])->name('corrigendum.update');
        Route::resource('/admin/whatsnews', whatsnews::class);
        Route::resource('/admin/module', module::class);
        Route::any('/admin/get_primarylink_menu', [AjaxRequestController::class,'get_primarylink_menu'])->name('/admin/get_primarylink_menu');
        Route::any('/admin/get_filter', [AjaxRequestController::class,'get_filter'])->name('/admin/get_filter');
        Route::any('/admin/delete_images', [AjaxRequestController::class,'delete_images'])->name('/admin/delete_images');
        Route::any('/admin/get_primarylink_module', [AjaxRequestController::class,'get_primarylink_module'])->name('/admin/get_primarylink_module');
        Route::any('/admin/update_menu_orders', [AjaxRequestController::class,'update_menu_orders'])->name('/admin/update_menu_orders');
        Route::any('/admin/update_sitemap_orders', [AjaxRequestController::class,'update_sitemap_orders'])->name('/admin/update_sitemap_orders');
		Route::any('/admin/update-whos-who-order', [AjaxRequestController::class,'update_whos_who_orders'])->name('update_whos_who_orders');
        Route::resource('/admin/faq', FaqController::class);
        Route::resource('/admin/gallery', gallery::class);
        Route::resource('/admin/videogallery', VideogalleryController::class);
        Route::resource('/admin/recruitment', recruitment::class);
        Route::resource('/admin/logo', logo::class);
        Route::resource('/admin/officers', officers::class);
        Route::resource('/admin/notifications', notifications::class);
        Route::resource('/admin/title', title::class);
        Route::resource('/admin/socialMedia', socialMedia::class);
        Route::resource('/admin/configuration', Configuration::class);
        Route::resource('/admin/feedback', Feedback::class);
        Route::resource('/admin/press-release', PressReleaseController::class);
        Route::resource('/admin/ministers-info', MinistersInfoController::class);
        Route::resource('/admin/guidelines', GuidelinesController::class);
		Route::resource('/admin/success', SuccessStoryController::class);
		Route::resource('/admin/consumer-products', ConsumerProductController::class);
        Route::any('/admin/get_minister_info_type', [AjaxRequestController::class,'get_minister_info_type'])->name('/admin/get_minister_info_type');
		Route::resource('/admin/audit-report', AuditController::class);
        Route::match(['get', 'post'],'/Auth/resetpassword', [App\Http\Controllers\Auth\ResetPasswordController::class,'resetpassword'])->name('password');
        Route::match(['get', 'post'],'/Auth/updatePassword', [App\Http\Controllers\Auth\ResetPasswordController::class,'updatePassword'])->name('updatePassword');
        Route::post('ckeditor/upload', [App\Http\Controllers\Admin\CKEditorController::class, 'upload'])->name('ckeditor.upload');
		Route::post('/admin/approve/{type}/{id}', [AdminApprovalController::class, 'approve'])->name('admin.approve');
        Route::post('logout', [login::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth','modulesAccess','inactivityTimeout']], function () {
        Route::resource('/admin/user', UserController::class);
        Route::resource('/admin/setting', WebsiteSettingController::class);
        Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::any('/admin/store', [UserController::class, 'store'])->name('/admin/user');
        Route::any('/admin/update', [UserController::class, 'update'])->name('/admin/user');
        Route::resource('/admin/user_role', User_roleController::class);
        Route::post('/admin/user_role/{$admin_role}', [User_roleController::class, 'destroy'])->name('admin_role');
        Route::resource('/admin/menu', menu::class);
        Route::resource('/admin/banner', banner::class);
        Route::resource('/admin/tender', tender::class);
		Route::get('/admin/corrigendum/add/{id}/{type}', [CorrigendumController::class, 'create'])->name('corrigendum.add');
        Route::post('/admin/corrigendum/store', [CorrigendumController::class, 'store'])->name('corrigendum.store');
        Route::get('/admin/corrigendum/edit/{id}/{type}', [CorrigendumController::class, 'edit'])->name('corrigendum.edit');
        Route::post('/admin/corrigendum/update/{id}', [CorrigendumController::class, 'update'])->name('corrigendum.update');
        Route::resource('/admin/whatsnews', whatsnews::class);
        Route::resource('/admin/module', module::class);
        Route::any('/admin/get_primarylink_menu', [AjaxRequestController::class,'get_primarylink_menu'])->name('/admin/get_primarylink_menu');
        Route::any('/admin/get_filter', [AjaxRequestController::class,'get_filter'])->name('/admin/get_filter');
        Route::any('/admin/get_primarylink_module', [AjaxRequestController::class,'get_primarylink_module'])->name('/admin/get_primarylink_module');
        Route::any('/admin/update_menu_orders', [AjaxRequestController::class,'update_menu_orders'])->name('/admin/update_menu_orders');
        Route::any('/admin/update_sitemap_orders', [AjaxRequestController::class,'update_sitemap_orders'])->name('/admin/update_sitemap_orders');
		Route::any('/admin/update-whos-who-order', [AjaxRequestController::class,'update_whos_who_orders'])->name('update_whos_who_orders');
        Route::resource('/admin/faq', FaqController::class);
        Route::resource('/admin/gallery', gallery::class);
        Route::resource('/admin/videogallery', VideogalleryController::class);
        Route::resource('/admin/recruitment', recruitment::class);
        Route::resource('/admin/logo', logo::class);
        Route::resource('/admin/officers', officers::class);
        Route::resource('/admin/notifications', notifications::class);
        Route::resource('/admin/title', title::class);
        Route::resource('/admin/socialMedia', socialMedia::class);
        Route::resource('/admin/configuration', Configuration::class);
        Route::resource('/admin/podcast', Podcast::class);
        Route::resource('/admin/press-release', PressReleaseController::class);
        Route::resource('/admin/ministers-info', MinistersInfoController::class);
        Route::resource('/admin/guidelines', GuidelinesController::class);
		Route::resource('/admin/success', SuccessStoryController::class);
		Route::resource('/admin/consumer-products', ConsumerProductController::class);
        Route::any('/admin/get_minister_info_type', [AjaxRequestController::class,'get_minister_info_type'])->name('/admin/get_minister_info_type');
		Route::resource('/admin/audit-report', AuditController::class);
        Route::match(['get', 'post'],'/Auth/resetpassword', [App\Http\Controllers\Auth\ResetPasswordController::class,'resetpassword'])->name('password');
        Route::match(['get', 'post'],'/Auth/updatePassword', [App\Http\Controllers\Auth\ResetPasswordController::class,'updatePassword'])->name('updatePassword');
        Route::post('logout', [login::class, 'logout'])->name('logout');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['inactivityTimeout'])->name('home');
Route::post('logout', [login::class, 'logout'])->name('logout');
Route::get('/feedback', [App\Http\Controllers\themes\HomeController::class, 'feedback'])->name('feedback');
Route::any('/feedback/process/', [App\Http\Controllers\themes\HomeController::class, 'feed_process'])->name('feed_process');  
Route::get('/screenreader', [App\Http\Controllers\themes\HomeController::class, 'screenreader'])->name('screenreader');  
Route::any('/search', [App\Http\Controllers\themes\HomeController::class, 'search'])->name('search');
Route::any('/site-map', [App\Http\Controllers\themes\HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/visitorcount', [App\Http\Controllers\themes\HomeController::class, 'visitorcount'])->name('visitorcount');


Route::get('/custom-301', function () {
        return response()->view('errors.301', [], Response::HTTP_MOVED_PERMANENTLY);
});