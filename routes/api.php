<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Passwords\PasswordController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Course\courseController;
use App\Http\Controllers\Like\LikesController;
use App\Http\Controllers\Review\InstructorsReviewController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\SaveCourse\SaveCourseController;
use App\Http\Controllers\Subscribe\SubscribeController;
use App\Http\Controllers\Users\GeneralUserController;
use App\Http\Controllers\VerifyKYC\KYCVerificationController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawalController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Notification\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send_reset_password_text/{username}', [PasswordController::class, 'validateForMessageSending'])->name('send_reset_password_text');
Route::post('/verify_token', [PasswordController::class, 'verifyToken'])->middleware(['guest'])->name('verify_token');
Route::post('/change_user_password', [PasswordController::class, 'changeUserPassword'])->name('change_user_password');

Route::post('/create-price', 'priceController@create');
Route::post('/create-category', 'CourseCategoryModelController@create');

Route::post('/handle_transfers', [TransactionController::class, 'handleTransfers'])->name('handle_transfers');
Route::post('/confirm_withdrawal_payment', [TransactionController::class, 'markWithdrawalsAsPaid'])->name('confirm_withdrawal_payment');

Route::post('/delete_transaction', [TransactionController::class, 'deleteTransactions'])->name('delete_transaction');

Route::post('/comfirm_user', [UserController::class, 'comfirmUser'])->name('comfirm_user');

Route::post('/delete_withdraw', [WithdrawalController::class, 'deleteWithdraws'])->name('delete_withdraw');

Route::post('/activateCoursesStatus', [courseController::class, 'activateCoursesStatus'])->name('activateCoursesStatus');
Route::post('/delete-course', [courseController::class, 'deleteCourses'])->name('delete-course');

//save course
Route::post('/saveCourse', [SaveCourseController::class, 'saveCourse'])->name('saveCourse');
Route::post('/removeSavedCourse', [SaveCourseController::class, 'removeSavedCourse'])->name('removeSavedCourse');

//likes & dislike
Route::post('/processCourseLikeStatus', [LikesController::class, 'processCourseLikeStatus'])->name('processCourseLikeStatus');

//subscribe to teachers
Route::post('/subscribeTOTeacher', [SubscribeController::class, 'subscribeTOTeacher'])->name('subscribeTOTeacher');

//store course reviews
Route::post('/storeReview', [ReviewController::class, 'storeReview'])->name('storeReview');
Route::get('/getAllReviews/{course_id}', [ReviewController::class, 'getAllReviews'])->name('getAllReviews');
Route::get('/getAllCourses/{course_id}', [ReviewController::class, 'getAllCourses'])->name('getAllCourses');

//notification handler
Route::get('/getAllNotification/{user_id}', [NotificationController::class, 'getAllNotification'])->name('getAllNotification');
Route::post('/addNotificationRead', [NotificationController::class, 'addNotificationRead'])->name('addNotificationRead');
Route::post('/deletNotification', [NotificationController::class, 'deletNotification'])->name('deletNotification');

//update users fcm key
Route::post('/updateUserFCMKeys/{user_unique_id}', [GeneralUserController::class, 'updateUserFCMKeys'])->name('updateUserFCMKeys');

//
Route::post('/KYCVerificationHandler', [KYCVerificationController::class, 'KYCVerificationHandler'])->name('KYCVerificationHandler');

//blog tags
Route::post('/store-blog-tags', [BlogController::class, 'storeBlogTags'])->name('store-blog-tags');
Route::post('/addNewBlog', [BlogController::class, 'storeBlog'])->name('addNewBlog');
Route::post('/confirmBlogPost', [BlogController::class, 'confirmBlogPost'])->name('confirmBlogPost');

//gallery/events
Route::post('/addNewGallery', [GalleryController::class, 'storeGallery'])->name('addNewGallery');
Route::post('/deleteGallery', [GalleryController::class, 'deleteGallery'])->name('deleteGallery');


//instructors comment
Route::post('/createInstructorComment', [InstructorsReviewController::class, 'createInstructorComment'])->name('createInstructorComment');
Route::post('/replyInstructorComment', [InstructorsReviewController::class, 'replyInstructorComment'])->name('replyInstructorComment');

//likes & dislike
Route::post('/processReviewLikeStatus', [InstructorsReviewController::class, 'processReviewLikeStatus'])->name('processReviewLikeStatus');
