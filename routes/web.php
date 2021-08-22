<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\priceController;

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Route\RouteController;
use App\Http\Controllers\Course\courseController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\Roles\AddRolesController;

use App\Http\Controllers\Roles\UserTypeController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Complain\ComplainController;
use App\Http\Controllers\Users\GeneralUserController;
use App\Http\Controllers\Wallet\WithdrawalController;
use App\Http\Controllers\Passwords\PasswordController;
use App\Http\Controllers\Referrals\ReferralController;
use App\Http\Controllers\Users\InstructorsControllers;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\CourseCategoryModelController;
use App\Http\Controllers\Search\SearchResultController;
use App\Http\Controllers\Subscribe\SubscribeController;
use App\Http\Controllers\Testmony\TestimoniesController;
use App\Http\Controllers\Course\CoursesHandlerController;
use App\Http\Controllers\SaveCourse\SaveCourseController;
use \App\Http\Controllers\Auth\AccountActivationController;
use App\Http\Controllers\AppSettings\AppSettingsController;
use App\Http\Controllers\Complain\ComplainHandleController;
use App\Http\Controllers\LiveStream\live_stream_controller;
use App\Http\Controllers\Verifications\VerifyBankController;
use App\Http\Controllers\CurrencyRate\CurrencyRateController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\VerifyKYC\KYCVerificationController;
use App\Http\Controllers\Enrollment\CourseEnrollmentController;
use App\Http\Controllers\Cryptocurrency\cryptocurrencyController;
//use App\Http\Controllers\PaymentAddress\PaymentAddressController;


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

Auth::routes();

Route::get('/show-csrf', [HomeController::class, 'showToken']);
Route::get('/clear-cache', [HomeController::class, 'clear_cache']);
// Route::get('/show-csrf', 'HomeController@showToken');
// Route::get('/clear-cache', 'HomeController@clear_cache');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//account activation
Route::post('/register_user', [RegistrationController::class, 'registerUsers'])->name('register_user');

//account activation
Route::get('/account_activation/{userId}', [AccountActivationController::class, 'accountActivationPage'])->name('account_activation');
Route::post('/activate_account/{typeOfCode}/{userId}', [AccountActivationController::class, 'verifyAndActivateAccount'])->name('activate_account');
Route::get('/send_account_activation_code/{userId}/{type_of_code}', [AccountActivationController::class, 'sendActivationCode'])->name('send_account_activation_code');

//password reset link page
Route::get('/forgot-password', [PasswordController::class, 'index'])->middleware(['guest'])->name('forgot-password');
//send email fpr password reset
Route::post('/send-reset-code', [PasswordController::class, 'initiatePasswordReset'])->middleware(['guest'])->name('send-reset-code');
Route::get('/re-send-reset-code/{username}', [PasswordController::class, 'resendPasswordResetCode'])->middleware(['guest'])->name('re-send-reset-code');
//verify reset password token
Route::get('/reset-password-area/{username}/{option?}', [PasswordController::class, 'showResetPasswordPage'])->middleware(['guest'])->name('reset-password-area');

//RESET THE PASSWORD
Route::post('/reset-password', [ResetPasswordController::class, 'resetThePassword'])->middleware(['guest'])->name('password.update');

//logged in fpr everythg category
Route::group(['middleware' => ['web', 'auth']], function () {
    // Course
    Route::get('/create-course',  [courseController::class, 'index'])->name('create-course');
    Route::get('/test',  [courseController::class, 'testEvent'])->name('test');
    Route::get('/view-courses',  [courseController::class, 'show'])->name('view-courses');
    Route::get('/view_course/{unique_id?}', [courseController::class, 'showCourses'])->name('view_course');
    Route::get('/edit-course/{id}', [courseController::class, 'update_page'])->name('edit-course');
    Route::get('/explore', [courseController::class, 'viewExplore'])->name('explore');
    Route::get('/category-explore/{unique_id?}', [courseController::class, 'exploreCategory'])->name('category-explore');
    Route::post('/create-course', [courseController::class, 'create']);
    Route::post('/edit-course/{id}', [courseController::class, 'update']);
    Route::post('/delete-course/{id}', [courseController::class, 'soft_delete']);

    // user routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/personal-details', [UserController::class, 'update_user_details']);
    Route::post('/profile/photo', [UserController::class, 'upload_cover_photo']);
    Route::get('/kyc_verification', [UserController::class, 'uploadUserCAC'])->name('kyc_verification');
    Route::post('/update_cac_file', [UserController::class, 'uploadCACFiles'])->name('update_cac_file');
    Route::post('/update_bank_account', [UserController::class, 'bankAccountUpdate'])->name('update_bank_account');
    Route::post('/update_wallet_address', [UserController::class, 'walletAddressUpdate'])->name('update_wallet_address');
    Route::post('/delete_user/{id}', [UserController::class, 'soft_delete']);

    //system settings
    Route::get('/main_settings_page', [AppSettingsController::class, 'mainSettings'])->name('main_settings_page');
    Route::get('/app_settings_page', [AppSettingsController::class, 'appSettings'])->name('app_settings_page');
    Route::post('/update_app_settings/{unique_id}', [AppSettingsController::class, 'updateAppSettings'])->name('update_app_settings');
    Route::post('/update_course_percent', [AppSettingsController::class, 'update_enrollment_percentage']);
    Route::post('/site_logo', [AppSettingsController::class, 'updateSiteLogo'])->name('site_logo');

    // Subscribe
    Route::get('/browse_subscribers', [SubscribeController::class, 'browseSubscribers'])->name('browse_subscribers');

    //wallet
    Route::get('/my_balance', [TransactionController::class, 'myTransaction'])->name('my_balance');
    Route::post('/top_up', [TransactionController::class, 'topUpWallet'])->name('top_up');
    Route::get('/confirm_top_up', [TransactionController::class, 'confirmUserPayments'])->name('confirm_top_up');
    Route::post('/transactions_by_date', [TransactionController::class, 'showTransactionByDate'])->name('transactions_by_date');
    Route::get('/transaction_history/{unique_id?}', [TransactionController::class, 'showTopUpTransaction'])->name('transaction_history');

    //withdrawals
    Route::get('/withdrawals', [WithdrawalController::class, 'myWithdrawals'])->name('withdrawals');
    //request withdrawals
    Route::post('/make_withdrawal', [WithdrawalController::class, 'storeWithdrawal'])->name('make_withdrawal');
    //show withdrawals by date
    Route::post('/withdrawals_by_date', [WithdrawalController::class, 'showWithdrawalsByDate'])->name('withdrawals_by_date');
    Route::get('/view-withdrawal-invoice/{unique_id?}', [WithdrawalController::class, 'viewWithdrawlInvoice'])->name('view-withdrawal-invoice');

    //add user type
    Route::get('/add_user_type', [UserTypeController::class, 'create'])->name('add_user_type');
    Route::get('/all_user_type', [UserTypeController::class, 'index'])->name('all_user_type');
    Route::post('/store_user_type', [UserTypeController::class, 'store'])->name('store_user_type');

    Route::get('/verify_kyc', [KYCVerificationController::class, 'listKYCForVerification'])->name('verify_kyc');
    Route::get('/verify_kyc_page/{unique_id}', [KYCVerificationController::class, 'verifyKYC'])->name('verify_kyc_page');

    //create Price For Course
    Route::get('/create_price', [priceController::class, 'create'])->name('create_price');
    Route::post('/store_price', [priceController::class, 'store'])->name('store_price');
    Route::get('/view_price', [priceController::class, 'index'])->name('view_price');
    Route::get('/edit_price/{id}', [priceController::class, 'show_edit'])->name('edit_price');
    Route::post('/update_price/{id}', [priceController::class, 'edit'])->name('update_price');
    Route::post('/delete_price/{id}', [priceController::class, 'soft_delete'])->name('delete_price');

    //create Course Category
    Route::get('/create_category', [CourseCategoryModelController::class, 'index'])->name('create_category');
    Route::get('/view_category', [CourseCategoryModelController::class, 'viewCoursesCategories'])->name('view_category');
    Route::post('/add_category', [CourseCategoryModelController::class, 'create'])->name('add_category');
    Route::get('/edit_category/{unique_id}', [CourseCategoryModelController::class, 'show'])->name('edit_category');
    Route::post('/update_category/{unique_id}', [CourseCategoryModelController::class, 'update'])->name('update_category');
    Route::post('/delete_category/{id}', [CourseCategoryModelController::class, 'soft_delete'])->name('delete_category');

    // Ticket
    Route::get('/ticket/create', [TicketController::class, 'create_ticket']);
    Route::get('/ticket/reply/{id}', [TicketController::class, 'reply_ticket']);
    Route::get('/ticket/all', [TicketController::class, 'view_all']);

    Route::post('/ticket/create', [TicketController::class, 'create']);
    Route::post('/ticket/reply/{id}', [TicketController::class, 'reply']);

    //users
    Route::get('/all_students', [AdminController::class, 'showAllStudents'])->name('all_students');
    Route::get('/all_instructor', [AdminController::class, 'showAllInstructor'])->name('all_instructor');
    Route::get('/all_users', [AdminController::class, 'show_all_users'])->name('all_users');

    // Live stream
    Route::get('/live_stream/create', [live_stream_controller::class, 'create_live'])->name('create_live');
    Route::get('/live_stream/all', [live_stream_controller::class, 'show'])->name('show_live_stream');
    // Route::get('/live_stream/all', [live_stream_controller::class, 'show_live_stream'])->name('show_live_stream');
    Route::get('/live_stream/edit/{id}', [live_stream_controller::class, 'update_page']);
    Route::get('/explore/live_streams', [live_stream_controller::class, 'explore_live_streams']);
    Route::get('/live_stream/details/{id}', [live_stream_controller::class, 'live_stream_details'])->name('stream_details');
    Route::post('/live/create', [live_stream_controller::class, 'create']);
    Route::post('/live/edit', [live_stream_controller::class, 'update']);
    Route::post('/delete-live/{id}', [live_stream_controller::class, 'soft_delete']);
});

//front end section
Route::get('/', [CoursesHandlerController::class, 'homePage'])->name('/');
Route::get('/list-courses', [CoursesHandlerController::class, 'getAllCourses'])->name('list-courses');
Route::get('/categories', [CoursesHandlerController::class, 'getAllCategories'])->name('categories');
Route::get('/instructors-list', [CoursesHandlerController::class, 'getAllInstructorsList'])->name('instructors-list');
//Route::get('/instructor-profile/{unique_id?}', [CoursesHandlerController::class, 'getInstructorProfile'])->name('instructor-profile');
Route::get('/course-list/{unique_id?}', [CoursesHandlerController::class, 'courseListPage'])->name('course-list');
Route::get('/course-details/{unique_id?}', [CoursesHandlerController::class, 'getCourseDetails'])->name('course-details');
Route::get('/instructor-courses/{unique_id?}', [CoursesHandlerController::class, 'teacherCourseListPage'])->name('instructor-courses');

Route::post('/search', [SearchResultController::class, 'searchThroughRecords'])->name('search');
Route::post('/search-result', [SearchResultController::class, 'searchThroughRecordsForBackview'])->name('search-result');

// front side web routes
Route::get('/about', [RouteController::class, 'aboutUsPage'])->name('about');
Route::get('/contact', [RouteController::class, 'contactUsPage'])->name('contact');
Route::get('/faq', [RouteController::class, 'faqPage'])->name('faq');
Route::get('/how-it-work', [RouteController::class, 'howItWorksPage'])->name('how-it-work');
Route::get('/terms-of-use', [RouteController::class, 'termsOfUsePage'])->name('terms-of-use');
Route::get('/privacy-policy', [RouteController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/affiliate', [RouteController::class, 'affiliatePage'])->name('affiliate');
Route::get('/career', [RouteController::class, 'careerPage'])->name('career');
Route::get('/teacher', [RouteController::class, 'teacherPage'])->name('teacher');
Route::get('/gallery', [RouteController::class, 'galleryPage'])->name('gallery');
Route::post('/contact-mail', [RouteController::class, 'contactUsMail'])->name('contact-mail');

//blogs
Route::get('/blog', [RouteController::class, 'blogPage'])->name('blog');
Route::get('/blog-details/{unique_id?}', [BlogController::class, 'blogDetailsInterface'])->name('blog-details');
Route::post('/blog-comment/{unique_id?}', [BlogController::class, 'blogPostComment'])->name('blog-comment');
Route::get('/create-blog-tag', [BlogController::class, 'createBlogTagInterface'])->name('create-blog-tag');
Route::get('/create-blog', [BlogController::class, 'createBlogInterface'])->name('create-blog');
Route::get('/blog-list', [BlogController::class, 'blogPostList'])->name('blog-list');


Route::get('/instructor-profile/{unique_id?}', [InstructorsControllers::class, 'intructorProfilePage'])->name('instructor-profile');

Route::get('/view_profile/{unique_id}', [GeneralUserController::class, 'viewUserGeneral'])->name('view_profile');
Route::get('/browse_instructor', [GeneralUserController::class, 'browseInstructors'])->name('browse_instructor');

// Testimonies
Route::get('/testimonies', [TestimoniesController::class, 'showTestimonies'])->name('testimonies');
Route::get('/add-testimonies', [TestimoniesController::class, 'createTestimony'])->name('add-testimonies');
Route::post('/store-testimonies', [TestimoniesController::class, 'storeNewTestimony'])->name('store-testimonies');

// Enroll in course
Route::get('/courses/enrolled', [CourseEnrollmentController::class, 'my_enrolled_courses'])->name('enrolled_course');
Route::get('/course/checkout/{id}', [CourseEnrollmentController::class, 'enroll_cart'])->name('checkout');
Route::post('/course/enroll/{id}', [CourseEnrollmentController::class, 'enroll']);
Route::post('/course/enroll/{id}', [CourseEnrollmentController::class, 'enroll']);
Route::post('/delete-enroll/{id}', [CourseEnrollmentController::class, 'soft_delete']);
Route::post('/delete-batch', [CourseEnrollmentController::class, 'batch_soft_Delete']);

Route::get('/notification-page/{unique_id?}', [NotificationController::class, 'notificationPage'])->name('notification-page');

//saved courses
Route::get('/saved-course', [SaveCourseController::class, 'getAllSavedCourse'])->name('saved-course');

//bank verification
Route::get('/verifications/bank', [VerifyBankController::class, 'index'])->name('account_validation');
Route::post('/verify-bank', [VerifyBankController::class, 'verifyBank'])->name('verify-bank');
Route::post('/add-bank', [VerifyBankController::class, 'addBank'])->name('add-bank');

Route::get('/complain_page', [ComplainController::class, 'complainPage'])->name('complain_page');
Route::post('/create_complain', [ComplainController::class, 'createComplain'])->name('create_complain');

Route::get('/complain_list', [ComplainHandleController::class, 'complainListForAdmin'])->name('complain_list');
Route::post('/activate_account', [ComplainHandleController::class, 'activateUserAccount'])->name('activate_account');
Route::post('/ignore_request', [ComplainHandleController::class, 'ignoreAccountActivateRequest'])->name('ignore_request');

//add roles area
Route::get('/add_roles', [RolesController::class, 'create'])->name('add_roles');
Route::get('/view_all_roles', [RolesController::class, 'index'])->name('view_all_roles');
Route::post('/store_role', [RolesController::class, 'store'])->name('store_role');
Route::get('/add_role_for_user/{userTypeId}', [AddRolesController::class, 'index'])->name('add_role_for_user');
Route::post('/store_role_for_user/{userTypeId}', [AddRolesController::class, 'store'])->name('store_role_for_user');


// gallery/event area
Route::get('/create-gallery', [GalleryController::class, 'createGalleryInterface'])->name('create-gallery');
Route::get('/gallery-list', [GalleryController::class, 'galleryList'])->name('gallery-list');

//update currency
Route::post('/update_user_currency', [CurrencyRateController::class, 'updateUserPreferredCurrency'])->name('update_user_currency');

// crypto currency
Route::get('/wallet/bitcoin/gateway/{id}', [cryptocurrencyController::class, 'payment_gateway'])->name('btc_gateway');
Route::get('/blockchain/callback', [cryptocurrencyController::class, 'confirm_payment'])->name('btc_callback');
// Route::get('/prev_address/{xpub}',[PaymentAddressController::class,'get_prev_addresses']);
// Route::post('/user/wallet/update',[cryptocurrencyController::class,'update_wallet']);
Route::post('/generate_address', [cryptocurrencyController::class, 'gen_payment_address']);
Route::post('/top_up_btc', [cryptocurrencyController::class, 'create_transaction'])->name('top_up_with_btc');

Route::get('/referral_earnings/{userId?}', [ReferralController::class, 'index'])->name('referral_earnings');
Route::get('/referral_details/{mainUserId?}/{referredUserId?}', [ReferralController::class, 'referralDetails'])->name('referral_details');

Route::post('/set_badge/{id}', [AdminController::class, 'set_user_verify_badge']);
