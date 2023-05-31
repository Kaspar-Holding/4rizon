<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DjAppController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\DJQuestionnaireController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EntranceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\VipPkgController;
use App\Http\Controllers\SplashController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ContactController;
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
RateLimiter::for('uploads', function (Request $request) {
    return $request->user()
                ? Limit::none()
                : Limit::perMinute(100);
});

Route::post('/payment_gateway' , [WebsiteController::class, 'payment_gateway'])->name('payment_gateway');

Route::group(['middleware' =>[
    'auth:sanctum', 'verified'
]], function(){
   
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::post('/boarding_status' , [EntranceController::class, 'boarding_status'])->name('boarding_status');
    Route::post('/payment_gateway2' , [UserController::class, 'payment_gateway2'])->name('payment_gateway2');
    Route::post('/payment_gateway' , [WebsiteController::class, 'payment_gateway'])->name('payment_gateway');
    Route::post('/chargeApi' , [UserController::class, 'chargeApi'])->name('chargeApi');
    Route::post('/save_token' , [UserController::class, 'save_token'])->name('save_token');
    Route::post('/find_user' , [EntranceController::class, 'find_user'])->name('find_user');
    Route::post('/register_user' , [UserController::class, 'register_user'])->name('register_user');
    Route::post('/registered_users' , [UserController::class, 'registered_users'])->name('registered_users');
    Route::post('/registered_users_status' , [UserController::class, 'registered_users_status'])->name('registered_users_status');
    Route::post('/add_vaccination' , [UserController::class, 'add_vaccination'])->name('add_vaccination');
    Route::post('/get_vaccination' , [UserController::class, 'get_vaccination'])->name('get_vaccination');
    Route::post('/login_user' ,  [UserController::class, 'user_login'])->name('login_user');
    Route::post('/user_delete' ,  [UserController::class, 'user_delete'])->name('user_delete');
    Route::post('/verify_user' ,  [UserController::class, 'verify_user'])->name('verify_user');
   
    Route::post('/email_verify_mail' , [UserController::class, 'email_verify_mail'])->name('email_verify_mail');
  
    Route::post('/register_test_user' , [UserController::class, 'register_test_user'])->name('register_test_user');
    Route::post('/email_verification' ,  [UserController::class, 'email_verification'])->name('email_verification');
    Route::post('/test_login_user' ,  [UserController::class, 'test_login_user'])->name('test_login_user');
    Route::post('/create_user' ,  [UserController::class, 'create_user'])->name('create_user');
    Route::get('/users_list_api' ,  [UserController::class, 'users_list_api'])->name('users_list_api');
    Route::post('/users_player_api' ,  [UserController::class, 'users_player_api'])->name('users_player_api');
    Route::get('/user_select_list_api' ,  [UserController::class, 'user_select_list_api'])->name('user_select_list_api');
    Route::post('/edit_user/{id}' ,  [UserController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user' ,  [UserController::class, 'update_user'])->name('update_user');
    Route::post('/update_artist' ,  [DjAppController::class, 'update_artist'])->name('update_artist');
    Route::post('/web_registration', [WebsiteController::class, 'web_registration'])->name('web_registration');
    Route::get('/get_gallery1', [WebsiteController::class, 'get_gallery1'])->name('get_gallery1');
    Route::get('/get_event_page', [WebsiteController::class, 'get_event_page'])->name('get_event_page');
    Route::post('/check_user' ,  [UserController::class, 'check_user'])->name('check_user');
    Route::post('/delete_user/{id}' ,  [UserController::class, 'deleteUser'])->name('delete_user');
    Route::post('/update_status' ,  [UserController::class, 'update_status'])->name('update_status');
    Route::post('/wallet_points' ,  [UserController::class, 'wallet_points'])->name('wallet_points');
    Route::post('/create_contact', [ContactController::class, 'create_contact'])->name('create_contact');
    Route::get('/dj_questionnaire' ,  [DJQuestionnaireController::class, 'dj_questionnaire_api'])->name('dj_questionnaire_list_api');
    Route::get('/get_dj_questionnaire_questions' ,  [DJQuestionnaireController::class, 'get_dj_questionnaire_questions'])->name('get_dj_questionnaire_questions');
    Route::get('/survey_list_api' ,  [SurveyController::class, 'survey_list_api'])->name('survey_list_api');
    Route::get('/get_questions_against_survey/{survey_id}/{user_id}' ,  [SurveyController::class, 'get_questions_against_survey'])->name('get_questions_against_survey');
    Route::post('/survey_completed' ,  [SurveyController::class, 'survey_completed'])->name('survey_completed');
    Route::get('/survey_check/{user_id}/{survey_id}' ,  [SurveyController::class, 'survey_check'])->name('survey_check');
    Route::get('/generate_token/{user_id}' ,  [UserController::class, 'generate_token'])->name('generate_token');
    Route::get('/verify_token/{user_id}/{token}' ,  [UserController::class, 'verify_token'])->name('verify_token');
    Route::post('/share_reward' ,  [UserController::class, 'share_reward'])->name('share_reward');
    
    Route::post('/biometric_status' ,  [UserController::class, 'biometric_status'])->name('biometric_status');

    Route::post('/update_password_api' ,  [UserController::class, 'update_password_api'])->name('update_password_api');
    Route::post('/update_password',[UserController::class, 'update_password'])->name('update_password');
    Route::post('/update_forget_password_api' ,  [UserController::class, 'update_forget_password_api'])->name('update_forget_password_api');

    Route::post('/dj_forget_password_api' ,  [UserController::class, 'dj_forget_password_api'])->name('dj_forget_password_api');
    Route::post('/notification' ,  [UserController::class, 'notification'])->name('notification');
    Route::post('/create_qr_code_event' ,  [EventController::class, 'create_qr_code_event'])->name('create_qr_code_event');
    Route::post('/user_going_to_event' ,  [EventController::class, 'user_going_to_event'])->name('user_going_to_event');
    Route::post('/user_event_attend' ,  [EventController::class, 'user_event_attend'])->name('user_event_attend');
    Route::post('/user_event_exit' ,  [EventController::class, 'user_event_exit'])->name('user_event_exit');
    Route::get('/event_list_api/{id}' ,  [EventController::class, 'event_list_api'])->name('event_list_api');

    Route::get('/single_event_api/{id}' ,  [EventController::class, 'single_event_api'])->name('single_event_api');
    Route::get('/get_bookings/{id}' ,  [EventController::class, 'get_bookings'])->name('get_bookings');
    Route::post('/remove_booking' ,  [EventController::class, 'remove_booking'])->name('remove_booking'); 
    Route::post('/invitation_status' ,  [EventController::class, 'invitation_status'])->name('invitation_status'); 
    Route::post('/dj_time_allocation', [EventController::class, 'dj_time_allocation'])->name('dj_time_allocation');
    Route::post('/showData', [EventController::class, 'showData'])->name('showData');
    
    Route::post('/manual_user_check', [EntranceController::class, 'manual_user_check'])->name('manual_user_check');
    Route::post('/manual_user_details', [EntranceController::class, 'manual_user_details'])->name('manual_user_details');

    Route::post('/manual_register_user', [EntranceController::class, 'manual_register_user'])->name('manual_register_user');
    Route::post('/manual_user_status_change', [EntranceController::class, 'manual_user_status_change'])->name('manual_user_status_change');

    Route::post('/manual_user_going_to_event', [EntranceController::class, 'manual_user_going_to_event'])->name('manual_user_going_to_event');
    Route::get('/manual_event_list' ,  [EntranceController::class, 'manual_event_list'])->name('manual_event_list');

    Route::post('/login_admin_user' ,  [UserController::class, 'login_admin_user'])->name('login_admin_user');
    Route::post('/user_in_club', [EntranceController::class, 'user_in_club'])->name('user_in_club');
    Route::post('/read_qr_code', [EntranceController::class, 'event_booking_qr_reading'])->name('read_qr_code');
    Route::post('/read_dj_qr_code', [EntranceController::class, 'dj_event_booking_qr_reading'])->name('read_dj_qr_code');
    Route::post('/check_booking_type', [EntranceController::class, 'check_booking_type'])->name('check_booking_type');
    Route::post('/read_shop_qr_code', [EntranceController::class, 'shop_qr_reading'])->name('read_shop_qr_code');
    Route::post('/change_event_status', [EntranceController::class, 'change_event_status'])->name('change_event_status');
    Route::post('/change_dj_event_status', [EntranceController::class, 'change_dj_event_status'])->name('change_dj_event_status');
    Route::post('/change_purchase_status', [EntranceController::class, 'change_purchase_status'])->name('change_purchase_status');
    Route::get('/currently_in_club', [EntranceController::class, 'currently_in_club'])->name('currently_in_club');
    Route::post('/user_n_event_details', [EntranceController::class, 'user_n_event_details'])->name('user_n_event_details');

    Route::post('/change_event_status', [EntranceController::class, 'change_event_status'])->name('change_event_status');
    Route::get('/currently_in_club', [EntranceController::class, 'currently_in_club'])->name('currently_in_club');
    Route::post('/user_n_event_details', [EntranceController::class, 'user_n_event_details'])->name('user_n_event_details');
    
    Route::get('/gallery_list_api/{id}' ,  [GalleryController::class, 'gallery_list_api'])->name('gallery_list_api');
    Route::get('/single_gallery_api/{id}' ,  [GalleryController::class, 'single_gallery_api'])->name('single_gallery_api');
    
    Route::get('/news_list_api' ,  [NewsController::class, 'news_list_api'])->name('news_list_api');
    Route::get('/single_news_api/{id}' ,  [NewsController::class, 'single_news_api'])->name('single_news_api');
    
    Route::get('/profile_user/{id}' ,  [UserController::class, 'profile_user'])->name('profile_user');
    Route::post('/update_profile' ,  [UserController::class, 'update_profile'])->name('update_profile');
    Route::post('/upload_user_files' ,  [UserController::class, 'upload_user_files'])->name('upload_user_files');
    Route::post('/update_profile_picture' ,  [UserController::class, 'update_profile_picture'])->name('update_profile_picture');
    
    Route::get('/get_available_coins/{id}' ,  [UserController::class, 'get_available_coins'])->name('get_available_coins');
    
    Route::get('/item_list_api' ,  [ItemController::class, 'item_list_api'])->name('item_list_api');
    Route::get('/get_attributes_and_values_api' ,  [ItemController::class, 'get_attributes_and_values_api'])->name('get_attributes_and_values_api');
    Route::get('/single_item_api/{id}' ,  [ItemController::class, 'single_item_api'])->name('single_item_api');
    
    
    Route::post('/purchase_item_api' ,  [PurchaseController::class, 'purchase_item_api'])->name('purchase_item_api');
    
    Route::get('/notification_api/{id}' ,  [AdminNotificationController::class, 'notification_api'])->name('notification_api');
    Route::get('/notification_status_api/{id}' ,  [AdminNotificationController::class, 'notification_status_api'])->name('notification_status_api');
    
    Route::get('/splash_list_api' ,  [SplashController::class, 'splash_list_api'])->name('splash_list_api');
    Route::get('/single_splash_api/{id}' ,  [SplashController::class, 'single_splash_api'])->name('single_splash_api');
    
    Route::get('/vip_booth_pkg_list_api' ,  [VipPkgController::class, 'vip_booth_pkg_list_api'])->name('vip_booth_pkg_list_api');
    Route::get('/single_vip_booth_pkg_api/{id}' ,  [VipPkgController::class, 'single_vip_booth_pkg_api'])->name('single_vip_booth_pkg_api');
    Route::post('/vip_booth_booking_api' ,  [VipPkgController::class, 'vip_booth_booking_api'])->name('vip_booth_booking_api');
    Route::post('/update_vip_booth_booking_api' ,  [VipPkgController::class, 'update_vip_booth_booking_api'])->name('update_vip_booth_booking_api');
    Route::post('/update_vip_booth_booking_status_api' ,  [VipPkgController::class, 'update_vip_booth_booking_status_api'])->name('update_vip_booth_booking_status_api');
    
    Route::post('/register_djuser' , [DjAppController::class, 'register_djuser'])->name('register_djuser');
    Route::post('/register_djuser_question' , [DjAppController::class, 'register_djuser_question'])->name('register_djuser_question');
    Route::post('/registered_djusers_status' , [DjAppController::class, 'registered_djusers_status'])->name('registered_djusers_status');
    Route::post('/login_djuser' , [DjAppController::class, 'login_djuser'])->name('login_djuser');
    Route::post('/dj_delete' , [DjAppController::class, 'dj_delete'])->name('dj_delete');
    Route::post('/verify_dj' , [DjAppController::class, 'verify_dj'])->name('verify_dj');
    Route::get('/music_genre' , [DjAppController::class, 'music_genre'])->name('music_genre');
    Route::get('/dj_agreement' , [DjAppController::class, 'dj_agreement'])->name('dj_agreement');
    Route::post('/dj_agreement_status_on' , [DjAppController::class, 'dj_agreement_status_on'])->name('dj_agreement_status_on');
    Route::post('/dj_agreement_status_check' , [DjAppController::class, 'dj_agreement_status_check'])->name('dj_agreement_status_check');
    Route::post('/dj_event_list_api' , [DjAppController::class, 'dj_event_list_api'])->name('dj_event_list_api');
    Route::post('/update_password' ,  [DjAppController::class, 'update_password'])->name('update_password');
    Route::post('/reset_password' ,  [DjAppController::class, 'reset_password'])->name('reset_password');
    Route::post('/reset_password_entrance' ,  [EntranceController::class, 'reset_password_entrance'])->name('reset_password_entrance');
    Route::post('/update_password_entrance' ,  [EntranceController::class, 'update_password_entrance'])->name('update_password_entrance');
    Route::post('/view_djadmin_details' ,  [DjAppController::class, 'view_djadmin_details'])->name('view_djadmin_details');
    Route::post('/dj_update_password' ,  [DjAppController::class, 'dj_update_password'])->name('dj_update_password');

    Route::post('/accept_event' ,  [DjAppController::class, 'accept_event'])->name('accept_event');
    Route::post('/reject_event' ,  [DjAppController::class, 'reject_event'])->name('reject_event');
    Route::post('/gallery_event_list' , [DjAppController::class, 'gallery_event_list'])->name('gallery_event_list');
    Route::post('/gallery_event_images' , [DjAppController::class, 'gallery_event_images'])->name('gallery_event_images');
    Route::post('/register_device' ,  [DjAppController::class, 'register_device'])->name('register_device');
    Route::post('/dj_booking_id' ,  [DjAppController::class, 'dj_booking_id'])->name('dj_booking_id');
    Route::post('/dj_notifications', [DjAppController::class, 'dj_notifications'])->name('dj_notifications');
    Route::post('/email_verify_mail_dj', [DjAppController::class, 'email_verify_mail_dj'])->name('email_verify_mail_dj');
    Route::post('/one_event' ,  [DjAppController::class, 'one_event'])->name('one_event');
    Route::post('/dj_notification_status_on' ,  [DjAppController::class, 'dj_notification_status_on'])->name('dj_notification_status_on');
    
    // Dashboard Routes
     Route::get('/dashboard', [DashboardController::class, 'get_data_api'])->name('dashboard'); 
     Route::get('/dashboard_count', [DashboardController::class, 'get_data_count_api'])->name('dashboard_count'); 
     Route::post('/dashboard_count_date', [DashboardController::class, 'get_data_count_date_api'])->name('dashboard_count_date'); 
     Route::get('/dashboard_count_now', [DashboardController::class, 'get_data_count_now'])->name('dashboard_count_now'); 


     // Coupons

    Route::post('/create_coupon', [CouponController::class, 'create_coupon'])->name('create_coupon'); 
    Route::post('/validate_coupon', [CouponController::class, 'validate_coupon'])->name('validate_coupon'); 
    Route::post('/coupon_usage', [CouponController::class, 'coupon_usage'])->name('coupon_usage'); 
    Route::post('/web_form', [WebsiteController::class, 'web_form'])->name('web_registration');
    Route::post('/web_otp', [WebsiteController::class, 'web_otp'])->name('web_otp');