<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\WebsiteUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionRoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\DealerLeadController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PaymentController;


use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\FrontAuthController;
use App\Http\Controllers\Front\BookingController;


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


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return '✅ Cache cleared successfully!';
});



// Route::get('/', function () {

//     return view('welcome');

// });

Route::get('/not-authorized', function () {
    return view('errors.not-authorized');
})->name('not.authorized');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/user-login');
})->name('logout');

Route::domain(config('app.domain'))->group(function () {

    // Route::get('/service', [FrontController::class, 'ServiceList'])->name('front.service');

        // here front controller
        Route::get('/', [FrontController::class, 'index']);
        Route::get('/contact', [FrontController::class, 'ContactCustomer']);
        Route::get('/user-login', [FrontAuthController::class, 'UserLoginForm'])->name('user_login_form');

        Route::post('/login-user', [FrontAuthController::class, 'loginUser'])->name('user_login');

        Route::get('/register', [FrontAuthController::class, 'Register']);
        Route::get('/get-cities', [FrontAuthController::class, 'getCities']);

        Route::post('/registeration', [FrontAuthController ::class, 'RegisterNow'])->name('registeration');

        Route::get('/all-service', [FrontController::class, 'ServiceList']);
        Route::get('/all-Sow/{id}', [FrontController::class, 'SowList']);
        Route::get('/sub-Sows/{id}', [FrontController::class, 'SubServiceSowLists']);

        Route::get('/sow-details/{id}', [BookingController::class, 'SowDetails']);


    Route::group(['middleware' =>'admin.guest'], function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.dologin');


    });

    // user middleware routes
    Route::group(['middleware' => 'user.auth'], function () {
        // here uer login handle auth
        Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/bookings', [BookingController::class, 'Booking']);
        Route::get('/payment-list', [DashboardController::class, 'PaymentsList']);

        Route::post('/create-order', [BookingController::class, 'createRazorpayOrder'])->name('razorpay.order.create');

        Route::get('/Custom-requirement-booking/{id}', [BookingController::class, 'CustomeRequirement']);

        Route::post('/custom-booking', [BookingController::class, 'storeCustomBooking'])->name('user.custom.booking');
        Route::post('/proceed-booking', [BookingController::class, 'ProceedToBooking'])->name('user.proceed.booking');

        Route::get('/booking-list', [DashboardController::class, 'BookingList'])->name('user.booking.list');
        Route::get('/booking-details/{id}', [DashboardController::class, 'BookingDetails'])->name('user.booking.details');
        Route::get('/user-profiles', [DashboardController::class, 'UserProfile'])->name('user.profiles');

        Route::get('/get-cities/{state_id}', [DashboardController::class, 'getCities']);

        Route::post('/user-update-profile}', [DashboardController::class, 'UpdateProfile'])->name('user.update_user_profile');

        Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('user.changePassword');

                // here payment controller
        Route::post('/milestone/payment', [PaymentController::class, 'payMilestone'])->name('user.milestone.payment');


    });

    Route::group(['middleware' =>'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/users', [AdminDashboardController::class, 'UsersPage']);
        Route::get('/service', [AdminDashboardController::class, 'Services']);

        Route::resource('admin_user', AdminUserController::class);
        Route::post('/admin_user/{id}/active-status', [AdminUserController::class, 'livePause'])->name('admin_user.activeStatus');

        Route::resource('website_user', WebsiteUserController::class);
        Route::post('/website_user/{id}/active-status', [WebsiteUserController::class, 'livePause'])->name('website_user.activeStatus');

        Route::resource('role', RoleController::class);
        Route::post('/role/{id}/active-status', [RoleController::class, 'livePause'])->name('role.activeStatus');

        Route::resource('permission', PermissionController::class);
        Route::post('/permission/{id}/active-status', [PermissionController::class, 'livePause'])->name('permission.activeStatus');

        Route::resource('permission_role', PermissionRoleController::class);
        Route::post('/permission_role/{id}/active-status', [PermissionRoleController::class, 'livePause'])->name('permission_role.activeStatus');
        Route::get('/get-permissions/{roleId}', [PermissionRoleController::class, 'getAllPermissions']);

        Route::resource('tags', TagController::class);
        Route::post('/tags/{id}/active-status', [TagController::class, 'livePause'])->name('tags.activeStatus');

        Route::resource('state', StateController::class);
        Route::post('/state/{id}/active-status', [StateController::class, 'livePause'])->name('state.activeStatus');

        Route::resource('city', CityController::class);
        Route::post('/city/{id}/active-status', [CityController::class, 'livePause'])->name('city.activeStatus');

        Route::get('/get-city-by-state-id', [CityController::class, 'getCityByStateId']);


        Route::resource('service', ServiceController::class);
        Route::post('/service/{id}/active-status', [ServiceController::class, 'livePause'])->name('service.activeStatus');

        Route::get('subServices',[ServiceController::class,'subServices']);
        Route::get('create-sub-services',[ServiceController::class,'CreatesubServices']);
        Route::get('/subServices/edit/{id}', [ServiceController::class, 'CreatesubServices'])->name('subservices.edit');

        Route::get('statement',[MasterController::class,'Statement'])->name('statement');
        Route::get('create-statement',[MasterController::class,'StatementCreate']);
        Route::get('edit-statement/{id}',[MasterController::class,'StatementCreate'])->name('statements.edit');
        Route::post('save-statement-work',[MasterController::class,'saveStatementOfWork'])->name('save.statement-work');
        Route::delete('destroy-statement/{id}',[MasterController::class,'destroyStatement'])->name('statements.destroy');

        Route::get('/get-subservices', [MasterController::class, 'getSubservices'])->name('get-subservices');


        Route::get('initial-payment-setting',[MasterController::class,'InitialPaymentSetting'])->name('initial-payment-setting');
        Route::get('create-initial-payment-setting',[MasterController::class,'CreateInitialPaymentSetting']);
        Route::get('edit-initial-payment-setting/{id}',[MasterController::class,'CreateInitialPaymentSetting'])->name('initial-payment-settings.edit');
        Route::post('store-initial-payment-setting',[MasterController::class,'storeOrUpdate'])->name('initial-payment-settings.store');
        Route::delete('destroy-intitial-payment/{id}',[MasterController::class,'destroyInitialPayment'])->name('initial-payment-settings.destroy');

        Route::get('gst-rate',[MasterController::class,'GstRate'])->name('gst.rate');
        Route::get('create-gst-rate',[MasterController::class,'CreateGstRate']);
        Route::get('edit-gst-rate/{id}',[MasterController::class,'CreateGstRate'])->name('gst-rates.edit');
        Route::post('store-gst-rate',[MasterController::class,'storeGst'])->name('gst-rates.store');
        Route::delete('delete-gst-rate/{id}',[MasterController::class,'DestroyGst'])->name('gst-rates.destroy');

        Route::get('user-profile',[MasterController::class,'UserProfile'])->name('user.profile');
        Route::get('create-user-profile',[MasterController::class,'CreateUserProfile']);
        Route::get('user-profiles/edit/{id}',[MasterController::class,'CreateUserProfile']);
        Route::post('store-user-profile',[MasterController::class,'storeUserProfile'])->name('store.user.profile');
        Route::delete('user-profiles/delete/{id}',[MasterController::class,'DestroyUserProfile']);
        Route::get('payments',[MasterController::class,'ShowPayments']);

        Route::get('currency',[MasterController::class,'Currency'])->name('currency');
        Route::post('store-currency',[MasterController::class,'CurrencyStore'])->name('store.currency');
        Route::delete('destroy-currency-delete/{id}',[MasterController::class,'Destroycurrency'])->name('currencies.destroy');

        Route::post('store-files',[MasterController::class,'storeFiles'])->name('allfiles.store');

        Route::post('/users/store', [AdminDashboardController::class, 'store'])->name('users.store');

        Route::post('/subservices/store', [ServiceController::class, 'storeSubServices'])->name('subservices.store');
        Route::delete('/subServices/{id}', [SubServiceController::class, 'destroySubservice'])->name('subservices.destroy');

        // here project routes
        Route::get('/projects', [ProjectController::class, 'ShowProject'])->name('projects');
        Route::get('/booking', [ProjectController::class, 'ShowBooking']);
        Route::post('/projects/update-status', [ProjectController::class, 'updateStatus']);
        Route::get('/projects-details/{id}', [ProjectController::class, 'ProjectDetails']);

          // web.php
        Route::get('/task-details', [ProjectController::class, 'TaskDetails'])->name('task.details');
        Route::post('/marked-complete', [ProjectController::class, 'MarkedCompleted'])->name('marked.complete');
        Route::post('/task-history/commit', [ProjectController::class, 'storeCommit']);
        Route::post('/task-history/delete', [ProjectController::class, 'DeleteTask']);

        Route::post('/milestone/store', [ProjectController::class, 'storeMilestone'])->name('milestone.store');
        Route::post('/task/store', [ProjectController::class, 'CreateTask'])->name('task.create');

        Route::post('/assign-accountmanager', [ProjectController::class, 'assignAccountMAnager'])->name('assign.accountmanager');
        Route::post('/assign-employee', [ProjectController::class, 'assignEmployee'])->name('assign.employee');

        Route::post('/milestone/request', [ProjectController::class, 'requestMilestone']);


        Route::get('/country', [CityController::class, 'Country'])->name('country');
        Route::get('/create-country', [CityController::class, 'CreateCountry'])->name('create.country');
        Route::get('/countries/{id}/edit', [CityController::class, 'CreateCountry'])->name('edit.country');
        Route::post('/store-country', [CityController::class, 'storeCountry'])->name('store.country');

        Route::delete('/countries/{id}', [CityController::class, 'destroyCountry'])->name('countries.destroy');

    });



});
