<?php

// use App\Http\Controllers\Admin\ContactUsPartnershipsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\HiringRoleController;
use App\Http\Controllers\Admin\CareerSpacesController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\ContactUsPartnershipsController;
use App\Http\Controllers\Api\VerifyEmailController;
use App\Http\Controllers\Crons\ExpireMeetingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\HiringBudgetController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\FieldOfStudyController;
use App\Http\Controllers\Admin\CompanyController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('UserPanel.pages.home.index');
})->name('/');
Route::get('/advisor', function () {
    return view('UserPanel.pages.advisor.index');
})->name('/advisor');
Route::get('/contact', function () {
    return view('UserPanel.pages.contactUs.index');
})->name('contact');
Route::post('post/general/inquiries', [ContactUsPartnershipsController::class,'contactUS'])
    ->name('post/general/inquiries');

Route::get('/about', function () {
    return view('UserPanel.pages.about.index');
})->name('about');

Route::get('/partner', function () {
    return view('UserPanel.pages.Partner.index');
})->name('partner');
Route::post('post/general/partnership', [ContactUsPartnershipsController::class,'partnerWithUs'])
    ->name('post/general/partnership');
//Language Change
//Route::get('lang/{locale}', function ($locale) {
//    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
//        abort(400);
//    }
//    Session()->put('locale', $locale);
//    Session::get('locale');
//    return redirect()->back();
//})->name('lang');

//Route::prefix('dashboard')->group(function () {
////    Route::view('index', 'dashboard.index')->name('index');
//    Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
//});

Route::prefix('page-layouts')->group(function () {
    Route::view('box-layout', 'page-layout.box-layout')->name('box-layout');
    Route::view('layout-rtl', 'page-layout.layout-rtl')->name('layout-rtl');
    Route::view('layout-dark', 'page-layout.layout-dark')->name('layout-dark');
    Route::view('hide-on-scroll', 'page-layout.hide-on-scroll')->name('hide-on-scroll');
    Route::view('footer-light', 'page-layout.footer-light')->name('footer-light');
    Route::view('footer-dark', 'page-layout.footer-dark')->name('footer-dark');
    Route::view('footer-fixed', 'page-layout.footer-fixed')->name('footer-fixed');
});

//Route::view('sample-page', 'pages.sample-page')->name('sample-page');
//Route::view('landing-page', 'pages.landing-page')->name('landing-page');

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});

//Route::prefix('layouts')->group(function () {
//    Route::view('compact-sidebar', 'admin_unique_layouts.compact-sidebar'); //default //Dubai
//    Route::view('box-layout', 'admin_unique_layouts.box-layout');    //default //New York //
//    Route::view('dark-sidebar', 'admin_unique_layouts.dark-sidebar');
//
//    Route::view('default-body', 'admin_unique_layouts.default-body');
//    Route::view('compact-wrap', 'admin_unique_layouts.compact-wrap');
//    Route::view('enterprice-type', 'admin_unique_layouts.enterprice-type');
//
//    Route::view('compact-small', 'admin_unique_layouts.compact-small');
//    Route::view('advance-type', 'admin_unique_layouts.advance-type');
//    Route::view('material-layout', 'admin_unique_layouts.material-layout');
//
//    Route::view('color-sidebar', 'admin_unique_layouts.color-sidebar');
//    Route::view('material-icon', 'admin_unique_layouts.material-icon');
//    Route::view('modern-layout', 'admin_unique_layouts.modern-layout');
//});

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');
Auth::routes();
Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('index');

    // User page Routes
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/get/user/{user}', [UserController::class, 'userEdit'])->name('/get/user');
    Route::post('/user/{user}', [UserController::class, 'updateUser'])->name('userRole/update');
    Route::post('/updateUserStatus', [UserController::class, 'updateUserStatus']);
    // settings route start

    Route::get('/experience/{experience}/edit', [SettingController::class, 'experienceedit'])->name('get/experience');
    Route::get('/userrole/{userRole}/edit', [SettingController::class, 'userRoleEdit'])->name('/get/user/role');
    Route::post('/experience/{experience}', [SettingController::class, 'experienceupdate'])->name('experience');
    Route::post('/userrole/{userRole}', [SettingController::class, 'userRoleUpdate'])->name('/role/title/update');

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::resource('hiring-roles', HiringRoleController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('hiring-budget', HiringBudgetController::class);
    });


    Route::prefix('dashboard')->group(function(){

        // Career Spaces
        Route::resource('spaces', CareerSpacesController::class);

        // Degrees
        Route::resource('degrees', DegreeController::class);

        // Schools
        Route::resource('schools', SchoolController::class);
        
        // FieldOfStudy
        Route::resource('fieldsOFStudy', FieldOfStudyController::class);

        // Companies
        Route::resource('companies', CompanyController::class);
    });


});
Route::get('expire-metting', [ExpireMeetingController::class, 'expireMeeting']);


