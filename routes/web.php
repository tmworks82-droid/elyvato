<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
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
use App\Http\Controllers\Admin\FaqController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PaymentController;


use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\FrontAuthController;
use App\Http\Controllers\Front\BookingController;

use App\Http\Controllers\Front\SocialAuthController;
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



// Route::get('/', function () {

//     return view('welcome');

// });

Route::get('/not-authorized', function () {
    return view('errors.not-authorized');
})->name('not.authorized');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



Route::domain(config('app.domain'))->group(function () {

    // Route::get('/service', [FrontController::class, 'ServiceList'])->name('front.service');

    Route::group(['middleware' =>'admin.guest'], function () {
        Route::get('/backoffice/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.dologin');

    });

    // user middleware routes
    Route::group(['middleware' => 'user.auth'], function () {
        // here uer login handle auth
        Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/bookings', [BookingController::class, 'Booking']);
        Route::get('/payment-list', [DashboardController::class, 'PaymentsList']);

        // Route::post('/create-order', [BookingController::class, 'createRazorpayOrder'])->name('razorpay.order.create');

        Route::get('/Custom-requirement-booking/{slug}', [BookingController::class, 'CustomeRequirement'])->name('post.custom.requirement');

        Route::post('/custom-booking', [BookingController::class, 'storeCustomBooking'])->name('user.custom.booking');
        // Route::post('/proceed-booking', [BookingController::class, 'ProceedToBooking'])->name('user.proceed.booking');
        Route::post('/proceed-to-hire', [BookingController::class, 'ProceedToInstantHire'])->name('user.proceed.hire');

        Route::get('/booking-list', [DashboardController::class, 'BookingList'])->name('user.booking.list');
        Route::get('/booking-details/{id}', [DashboardController::class, 'BookingDetails'])->name('user.booking.details');
        Route::get('/user/profiles', [DashboardController::class, 'UserProfile'])->name('user.profiles');

        Route::get('/get-cities/{state_id}', [DashboardController::class, 'getCities']);

        Route::post('/user-update-profile}', [DashboardController::class, 'UpdateProfile'])->name('user.update_user_profile');

        Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('user.changePassword');

        // here payment controller
        Route::post('/milestone/payment', [PaymentController::class, 'payMilestone'])->name('user.milestone.payment');
        Route::post('/request-invoice', [PaymentController::class, 'requestInvoice'])->name('request.invoice');

        Route::get('user/subscription-booking', [DashboardController::class, 'SubscriptionBooking'])->name('user.subscription.booking');
        Route::post('/cancel-subscription', [DashboardController::class, 'SubscriptionAction'])->name('subscription.cancel');


    });


    Route::group(['middleware' =>'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');



        Route::get('/users', [AdminDashboardController::class, 'UsersPage']);
        Route::get('/service', [AdminDashboardController::class, 'Services']);

        Route::resource('admin_user', AdminUserController::class);
        Route::post('/admin_user/{id}/active-status', [AdminUserController::class, 'livePause'])->name('admin_user.activeStatus');


        Route::get('admin-user-profile', [AdminUserController::class,'UpdateUserProfile'])->name('admin.profile');
        Route::post('admin-user-profile-update', [AdminUserController::class,'EditProfile'])->name('update.profile.store');




        Route::resource('role', RoleController::class);
        Route::post('/role/{id}/active-status', [RoleController::class, 'livePause'])->name('role.activeStatus');

        Route::resource('permission', PermissionController::class);
        Route::post('/permission/{id}/active-status', [PermissionController::class, 'livePause'])->name('permission.activeStatus');

        Route::resource('permission_role', PermissionRoleController::class);
        Route::post('/permission_role/{id}/active-status', [PermissionRoleController::class, 'livePause'])->name('permission_role.activeStatus');
        Route::get('/get-permissions/{roleId}', [PermissionRoleController::class, 'getAllPermissions']);

        // Route::resource('tags', TagController::class);
        // Route::post('/tags/{id}/active-status', [TagController::class, 'livePause'])->name('tags.activeStatus');

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
        
        Route::get('hire-talent',[MasterController::class,'HireTalent'])->name('admin.hire.talent');
        Route::get('create-hire-talent',[MasterController::class,'CreateHireTalent'])->name('admin.createhire.talent');
        // Route::get('create-hire-talent',[MasterController::class,'CreateHireTalent'])->name('admin.createhire.talent');
        Route::get('edit-hire-talent/{id}',[MasterController::class,'HireTalentEdit'])->name('admin.edit.talent');
        Route::post('store-hire-talent',[MasterController::class,'HireTalentStore'])->name('store.hire.talent');
        Route::delete('destroy-hire-talent/{id}',[MasterController::class,'HireTalentDestroy'])->name('admin.destroy.talent');
        
        Route::post('/toggle-clock', [MasterController::class, 'toggleClock']);
        
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

        Route::post('/delete-file', [MasterController::class, 'deleteFile'])->name('delete.file');


        Route::post('/users/store', [AdminDashboardController::class, 'store'])->name('users.store');

        Route::post('/subservices/store', [ServiceController::class, 'storeSubServices'])->name('subservices.store');
        Route::delete('/subServices/{id}', [ServiceController::class, 'destroySubservice'])->name('subservices.destroy');

        // here project routes
        Route::get('/projects', [ProjectController::class, 'ShowProject'])->name('projects');
        Route::post('/update-booking-visited', [ProjectController::class, 'updateBookingVisited']);

        Route::get('/booking', [ProjectController::class, 'ShowBooking']);
        Route::get('/booking-calls/{id}', [ProjectController::class, 'BookingCalls']);
        Route::post('/call-schedule/update', [ProjectController::class, 'updateCallSchedule'])->name('booking.callschedule');
        Route::post('/call-re-schedule/update', [ProjectController::class, 'ReScheduleCall'])->name('re.callschedule');
        
        Route::post('/call-booking-status', [ProjectController::class, 'markCompleted'])->name('call.booking.status');
        Route::post('/projects/update-status', [ProjectController::class, 'updateStatus']);
        Route::get('/projects-details/{id}', [ProjectController::class, 'ProjectDetails']);
        Route::post('/mannual-assign-booking', [ProjectController::class, 'MannualAssignToBooking'])->name('mannual.assign.booking');
        Route::post('/update-project-details', [ProjectController::class, 'UpdateProjectDetails'])->name('update.project.details');
        

          // web.php
        Route::get('/task-list', [ProjectController::class, 'TaskList'])->name('task.list');

        Route::get('/task-details', [ProjectController::class, 'TaskDetails'])->name('task.details');
        Route::post('/marked-complete', [ProjectController::class, 'MarkedCompleted'])->name('marked.complete');
        Route::post('/task-history/commit', [ProjectController::class, 'storeCommit']);
        Route::post('/task-history/delete', [ProjectController::class, 'DeleteTask']);

        Route::post('/milestone/store', [ProjectController::class, 'storeMilestone'])->name('milestone.store');
        Route::post('/task/store', [ProjectController::class, 'CreateTask'])->name('task.create');

        Route::post('/assign-accountmanager', [ProjectController::class, 'assignAccountMAnager'])->name('assign.accountmanager');
        Route::post('/assign-employee', [ProjectController::class, 'assignEmployee'])->name('assign.employee');

        Route::post('/milestone/request', [ProjectController::class, 'requestMilestone']);
        Route::post('/reminder/mail', [ProjectController::class, 'ReminderMail'])->name('reminder.mail');


        Route::get('/country', [CityController::class, 'Country'])->name('country');
        Route::get('/create-country', [CityController::class, 'CreateCountry'])->name('create.country');
        Route::get('/countries/{id}/edit', [CityController::class, 'CreateCountry'])->name('edit.country');
        Route::post('/store-country', [CityController::class, 'storeCountry'])->name('store.country');

        Route::delete('/countries/{id}', [CityController::class, 'destroyCountry'])->name('countries.destroy');

        //Faq routes here 
        Route::get('/faq', [FaqController::class, 'index'])->name('index');
        Route::get('/create-faq', [FaqController::class, 'Create'])->name('faq.create');
        Route::post('/store-faq', [FaqController::class, 'Store'])->name('faq.store');
        Route::get('/edit-faq/{id}', [FaqController::class, 'Edit'])->name('faq.edit');
        Route::delete('/destroy-faq/{id}', [FaqController::class, 'Destroy'])->name('faq.destroy');

        Route::get('/case-study', [MasterController::class, 'CaseStudy'])->name('case.study');
        Route::get('/case-study-create', [MasterController::class, 'CreateCase'])->name('case.study.create');
        Route::post('/case-study-store', [MasterController::class, 'CaseStudyStore'])->name('case.study.store');
        Route::get('/edit-case-study/{id}', [MasterController::class, 'CaseEdit'])->name('case.edit');
        Route::delete('/destroy-case/{id}', [MasterController::class, 'CaseDestroy'])->name('case.destroy');



        Route::get('/blogs', [MasterController::class, 'Blog'])->name('post.blog');
        Route::get('/search-blog', [FrontController::class, 'searchBlog'])->name('blog.search');

        Route::get('/create-blog', [MasterController::class, 'BlogCreate'])->name('blog.create');
        Route::post('/store-blog', [MasterController::class, 'BlogStore'])->name('blog.store');
         Route::get('/edit-blog/{id}', [MasterController::class, 'BlogEdit'])->name('blog.edit');
        Route::delete('/destroy-blog/{id}', [MasterController::class, 'BlogDestroy'])->name('blog.destroy');

    });


            // here front controller
        Route::post('/contact-store', [FrontController::class, 'store'])->name('contact.store');

        Route::get('/comming-soon', [FrontController::class, 'CommingSoon'])->name('comming.soon');

        Route::post('/create-order', [BookingController::class, 'createRazorpayOrder'])->name('razorpay.order.create');
        Route::post('/proceed-booking', [BookingController::class, 'ProceedToBooking'])->name('user.proceed.booking');
        
        Route::get('/', [FrontController::class, 'index']);
        Route::get('/contact', [FrontController::class, 'ContactCustomer']);
        Route::get('/login', [FrontAuthController::class, 'UserLoginForm'])->name('user_login_form');
        
        // Route::post('/toggle-clock', [FrontController::class, 'toggleClock']);
        
          // Social Login Routes
        Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
            ->where('provider', 'google|facebook')
            ->name('social.redirect');
        
        Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
            ->where('provider', 'google|facebook')
            ->name('social.callback');
            
            

        Route::get('/forgot/password', [FrontAuthController::class, 'ForgetPassword'])->name('forget.password');
        Route::post('/send-otp', [FrontAuthController::class, 'sendOtp'])->name('send.otp');
        Route::get('/password/reset/{token}', [FrontAuthController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('/password/reset', [FrontAuthController::class, 'resetPassword'])->name('password.reset');

        Route::post('/login-user', [FrontAuthController::class, 'loginUser'])->name('user_login');

        Route::get('/register', [FrontAuthController::class, 'Register']);
        Route::get('/get-cities', [FrontAuthController::class, 'getCities']);

        Route::post('/registeration', [FrontAuthController ::class, 'RegisterNow'])->name('registeration');
        Route::get('/about', [FrontController::class, 'About'])->name('about');
        Route::get('/invoice', [FrontController::class, 'Invoice'])->name('invoice');
        Route::get('/case-studies', [FrontController::class, 'CaseStudy'])->name('case.index');

        Route::get('/blog', [FrontController::class, 'Blog'])->name('blog');
        Route::get('/blog/{slug}', [FrontController::class, 'BlogPage'])->name('blog.single.page');
        Route::get('/blog/{categorySlug}/{blogSlug}', [FrontController::class, 'BlogCategory'])->name('blog.category.page');
        Route::get('/terms-of-services', [FrontController::class, 'TermsService'])->name('terms.of.services');
        Route::get('/privacy-policy', [FrontController::class, 'PrivacyPolicy']);
        // Route::get('/sow-details/{id}', [BookingController::class, 'SowDetails']);

        Route::get('/search-services', [FrontController::class, 'searchServices'])->name('ajax.search.services');
        Route::get('/ajax/default-services', [FrontController::class, 'getDefaultServices'])->name('ajax.default.services');

        Route::get('/instant-hire-list', [FrontController::class, 'InstantHireList'])->name('instant.hire.list');
        // Route::post('/proceed-to-hire', [BookingController::class, 'ProceedToInstantHire'])->name('user.proceed.hire');
        Route::get('/instant/hire/{slug?}', [BookingController::class, 'InstantHire'])->name('instant.hire.booking');
     
        Route::get('/services', [FrontController::class, 'ServiceList'])->name('all-service');
        Route::get('{slug}', [FrontController::class, 'ServiceSowList'])->name('service-sow-list');   
        Route::get('/{serviceSlug}/{subserviceSlug}', [FrontController::class, 'SubServiceSowLists'])->name('sub-service-sow');

        //Route::get('sow/{serviceSubserviceSlug}/{sowSlug}', [BookingController::class, 'SowDetails'])->name('sow.details');

       //  (service + sow)
        Route::get('service/{serviceSlug}/{sowSlug}', [BookingController::class, 'SowDetails'])->name('sow.details.service');
        
       // New: (service + subservice + sow)
        Route::get('{serviceSlug}/{subserviceSlug}/{sowSlug}', [BookingController::class, 'SowDetails'])->name('sow.details.sub');



});
