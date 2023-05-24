<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Input;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DjAppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DJQuestionnaireController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EntranceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WeeklyLineupController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemElementController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VipPkgController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\SplashController;
use App\Models\Event;
use Carbon\Carbon;
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
Route::post('/update_password',[UserController::class, 'update_password'])->name('update_password');
Route::get('/reset_password_entrance',[UserController::class, 'reset_password_entrance'])->name('reset_password_entrance');

Route::post('/update_password_admin',[UserController::class, 'update_password_admin'])->name('update_password_admin');
Route::get('/reset_password_admin',[UserController::class, 'reset_password_admin'])->name('reset_password_admin');
Route::get('/r_pass',[UserController::class, 'r_pass'])->name('r_pass');
Route::post('/update_forget_password_admin',[UserController::class, 'update_forget_password_admin'])->name('update_forget_password_admin');
Route::get('/dj_reset_password',[UserController::class, 'dj_reset_password'])->name('dj_reset_password');
Route::get('/payment_gateway',[WebsiteController::class, 'payment_gateway'])->name('payment_gateway');
Route::get('/email_sent',[UserController::class, 'email_sent'])->name('email_sent');
Route::get('/success',[UserController::class, 'success'])->name('success');

Route::group(['middleware' =>[
    'auth:sanctum', 'verified'
]], function(){
    // Dashboard Routes

    Route::get('/dashboard', [DashboardController::class, 'get_data'])->name('dashboard');
    Route::get('/layout', [DashboardController::class, 'layout'])->name('layout');
    // User Routes
    Route::get('/export-csv', [UserController::class, 'exportCSV'])->name('exportCSV');
    Route::get('/export-djcsv', [UserController::class, 'exportdjCSV'])->name('exportdjCSV');
    Route::get('/purchase_list' ,  [UserController::class, 'purchase_list'])->name('purchase_list');
Route::post('confirm_delete', [userController::class, 'confirm_delete'])->name('confirm_delete');

    Route::get('/add_new_user', [UserController::class, 'add_new_user'])->name('add_new_user');
    Route::post('/add_user',[UserController::class, 'create'])->name('add_user');
    Route::get('/delete_timeslot/{id}', [EventController::class, 'delete_timeslot'])->name('delete_timeslot');
    Route::get('/admin_list' ,  [UserController::class, 'admin_list'])->name('admin_list');
    Route::get('/edit_admin_details/{id}' ,  [UserController::class, 'edit_admin_details'])->name('edit_admin_details');
    Route::get('/delete_admin_details/{id}' ,  [UserController::class, 'delete_admin_details'])->name('delete_admin_details');
    Route::post('/update_admin_user', [UserController::class, 'update_admin_user'])->name('update_admin_user');
    Route::get('/users_list' ,  [UserController::class, 'users_list'])->name('users_list');
    Route::get('/users_lists/{fromdate}/{todate}' ,  [UserController::class, 'users_lists'])->name('users_lists');
    Route::get('/users_list1' ,  [UserController::class, 'users_list'])->name('gallery_list');
    Route::get('/active_users' ,  [UserController::class, 'active_users'])->name('active_users');
    Route::get('/active_users_list/{fromdate}/{todate}' ,  [UserController::class, 'active_users_list'])->name('active_users_list');
    Route::get('/inactive_users' ,  [UserController::class, 'inactive_users'])->name('inactive_users');
    Route::get('/users_record' ,  [UserController::class, 'users_record'])->name('users_record');
    Route::get('/denied_users' ,  [UserController::class, 'denied_users'])->name('denied_users');
    Route::get('/blocked_users' ,  [UserController::class, 'blocked_users'])->name('blocked_users');
    Route::get('/inactives_users/{fromdate}/{todate}' ,  [UserController::class, 'inactives_users'])->name('inactives_users');
    Route::get('/invalid_users' ,  [UserController::class, 'invalid_users'])->name('invalid_users');
    Route::get('/invalid_users_lists/{fromdate}/{todate}' ,  [UserController::class, 'invalid_users_lists'])->name('invalid_users_lists');
    Route::get('/view_user_details/{id}', [UserController::class, 'view_user_details'])->name('view_user_details');
    Route::post('/multiple_approve', [UserController::class, 'multiple_approve'])->name('multiple_approve');
    Route::post('/multiple_delete', [UserController::class, 'multiple_delete'])->name('multiple_delete');
    Route::post('/multiple_approve_dj', [UserController::class, 'multiple_approve_dj'])->name('multiple_approve_dj');
    Route::get('/delete_user_details/{id}' ,  [UserController::class, 'delete_user_details'])->name('delete_user_details');
    Route::post('/user_status_update', [UserController::class, 'user_status_update'])->name('user_status_update');
    Route::get('/approve_dj_user/{id}', [DJAppController::class, 'approve_djuser'])->name('approve_dj_user');
    Route::get('/approve_user/{id}', [UserController::class, 'approve_user'])->name('approve_user');
    Route::get('/deny_user/{id}', [UserController::class, 'deny_user'])->name('deny_user');
    Route::get('/block_user/{id}', [UserController::class, 'block_user'])->name('block_user');
    Route::get('/fetch_dha_profile/{id}', [UserController::class, 'fetch_dha_profile'])->name('fetch_dha_profile');
    Route::get('/register_new_user', [UserController::class, 'register_new_user'])->name('register_new_user');
    Route::post('/save_user',[UserController::class, 'save_user'])->name('save_user');
    Route::get('/fetch_dj_dha_profile/{id}', [UserController::class, 'fetch_dj_dha_profile'])->name('fetch_dj_dha_profile');
    Route::get('/edit_user_details/{id}' ,  [UserController::class, 'edit_user_details'])->name('edit_user_details');
    Route::post('/update_user_db', [UserController::class, 'update_user_db'])->name('update_user_db');
    Route::post('admin_delete', [UserController::class, 'admin_delete'])->name('admin_delete');
    
    
    //DJ Routes
    
    Route::get('/register_new_djuser', [DjAppController::class, 'register_new_djuser'])->name('register_new_djuser');
    Route::post('/save_djuser',[DjAppController::class, 'save_djuser'])->name('save_djuser');
    Route::post('artist_delete', [DjAppController::class, 'artist_delete'])->name('artist_delete');

    Route::get('/admin_djlist' ,  [DjAppController::class, 'admin_djlist'])->name('admin_djlist');
    
    Route::get('/dj_event_attend_list' ,  [DjAppController::class, 'dj_event_attend_list'])->name('dj_event_attend_list');
    Route::get('/edit_djadmin_details/{id}' ,  [DjAppController::class, 'edit_djadmin_details'])->name('edit_djadmin_details');
    Route::get('/artistResponse/{id}' ,  [DjAppController::class, 'artistResponse'])->name('artistResponse');

    Route::get('/view_djadmin_details/{id}' ,  [DjAppController::class, 'view_djadmin_details'])->name('view_djadmin_details');
    Route::get('/delete_djadmin_details/{id}' ,  [DjAppController::class, 'delete_djadmin_details'])->name('delete_djadmin_details');
    Route::post('/update_djadmin_user', [DjAppController::class, 'update_djadmin_user'])->name('update_djadmin_user');
    
    Route::get('/total_points_collected', [UserController::class, 'total_points_collected'])->name('total_points_collected');
    Route::get('/total_points_collects/{fromdate}/{todate}', [UserController::class, 'total_points_collects'])->name('total_points_collects');
    Route::get('/total_points_redeemed', [UserController::class, 'total_points_redeemed'])->name('total_points_redeemed');
    Route::get('/total_points_redeem/{fromdate}/{todate}', [UserController::class, 'total_points_redeem'])->name('total_points_redeem');
    Route::get('/total_qr_scans', [UserController::class, 'total_qr_scans'])->name('total_qr_scans');
    // Survey Routes
    Route::post('survey_delete', [SurveyController::class, 'survey_delete'])->name('survey_delete');

    Route::get('/survey_list' ,  [SurveyController::class, 'survey_list'])->name('survey_list');
    Route::get('/add_new_survey', [SurveyController::class, 'add_new_survey'])->name('add_new_survey');
    Route::get('/delete_survey/{id}', [SurveyController::class, 'delete_survey'])->name('delete_survey');
    Route::post('/create_survey',[SurveyController::class, 'create_survey'])->name('create_survey');;
    Route::get('/edit_survey/{id}', [SurveyController::class, 'edit_survey'])->name('edit_survey');
    Route::post('/survey_update', [SurveyController::class, 'survey_update'])->name('survey_update');
    Route::get('/view_survey_questions/{id}', [SurveyController::class, 'view_survey_questions'])->name('view_survey_questions');
    Route::get('/add_new_question/{id}', [SurveyController::class, 'add_new_question'])->name('add_new_question');
    Route::post('/create_question',[SurveyController::class, 'create_question'])->name('create_question');
    Route::get('/edit_question/{id}', [SurveyController::class, 'edit_question'])->name('edit_question');
    Route::get('/delete_question/{id}', [SurveyController::class, 'delete_question'])->name('delete_question');
    Route::post('/update_question', [SurveyController::class, 'update_question'])->name('update_question');
    Route::get('/view_survey_answers/{id}', [SurveyController::class, 'view_survey_answers'])->name('view_survey_answers');
    Route::get('/add_new_answer/{id}', [SurveyController::class, 'add_new_answer'])->name('add_new_answer');
    Route::post('/create_answer',[SurveyController::class, 'create_answer']);
    Route::get('/edit_answer/{id}', [SurveyController::class, 'edit_answer'])->name('edit_answer');
    Route::post('/update_answer', [SurveyController::class, 'update_answer'])->name('update_answer');
    // Event Routes
    Route::get('/users_event_attend_list' ,  [EventController::class, 'users_event_attend_list'])->name('users_event_attend_list');
    Route::post('event_delete', [EventController::class, 'event_delete'])->name('event_delete');
    Route::get('/users_transaction_list' ,  [EventController::class, 'users_transaction_list'])->name('users_transaction_list');
    Route::get('/users_events_attend_lists/{fromdate}/{todate}' ,  [EventController::class, 'users_events_attend_lists'])->name('users_events_attend_lists');
    Route::get('/view_user_event_details/{id}', [EventController::class, 'view_user_event_details'])->name('view_user_event_details');
    Route::get('/event_list' ,  [EventController::class, 'event_list'])->name('event_list');
    Route::get('/add_new_event', [EventController::class, 'add_new_event'])->name('add_new_event');
    Route::post('/create_event', [EventController::class, 'create_event'])->name('create_event');
    Route::post('/payment', [EventController::class, 'payment'])->name('payment');

    Route::get('/edit_event/{id}', [EventController::class, 'edit_event'])->name('edit_event');
    Route::post('/showData', [EventController::class, 'showData'])->name('showData');
    Route::post('/update_event', [EventController::class, 'update_event'])->name('update_event');
    Route::post('/update_start_time', [EventController::class, 'update_start_time'])->name('update_start_time');
    Route::post('/update_end_time', [EventController::class, 'update_end_time'])->name('update_end_time');
    Route::post('/dj_time_allocation', [EventController::class, 'dj_time_allocation'])->name('dj_time_allocation');
    Route::get('/delete_event/{id}', [EventController::class, 'delete_event'])->name('delete_event');
    // WeeklyLineup Routes
    Route::get('/weekly_lineup_list' ,  [WeeklyLineupController::class, 'weekly_lineup_list'])->name('weekly_lineup_list');
    Route::get('/add_new_weekly_lineup', [WeeklyLineupController::class, 'add_new_weekly_lineup'])->name('add_new_weekly_lineup');
    Route::post('/create_weekly_lineup', [WeeklyLineupController::class, 'create_weekly_lineup'])->name('create_weekly_lineup');
    Route::get('/edit_weekly_lineup/{id}', [WeeklyLineupController::class, 'edit_weekly_lineup'])->name('edit_weekly_lineup');
    Route::post('/update_weekly_lineup', [WeeklyLineupController::class, 'update_weekly_lineup'])->name('update_weekly_lineup');
    Route::get('/delete_weekly_lineup/{id}', [WeeklyLineupController::class, 'delete_weekly_lineup'])->name('delete_weekly_lineup');
    Route::post('lineup_delete', [WeeklyLineupController::class, 'lineup_delete'])->name('lineup_delete');
    // Gallery Routes
    Route::get('/gallery_list' ,  [GalleryController::class, 'gallery_list'])->name('gallery_list');
    Route::post('gallery_delete', [GalleryController::class, 'gallery_delete'])->name('gallery_delete');

    Route::get('/add_new_gallery', [GalleryController::class, 'add_new_gallery'])->name('add_new_gallery');
    Route::post('/create_gallery', [GalleryController::class, 'create_gallery'])->name('create_gallery');
    Route::get('/edit_gallery/{id}', [GalleryController::class, 'edit_gallery'])->name('edit_gallery');
    Route::post('/update_gallery', [GalleryController::class, 'update_gallery'])->name('update_gallery');
    Route::get('/delete_gallery/{id}', [GalleryController::class, 'delete_gallery'])->name('delete_gallery');
    // News Routes
    Route::get('/news_list' ,  [NewsController::class, 'news_list'])->name('news_list');
    Route::get('/add_news', [NewsController::class, 'add_news'])->name('add_news');
    Route::post('/create_news', [NewsController::class, 'create_news'])->name('create_news');
    Route::get('/edit_news/{id}', [NewsController::class, 'edit_news'])->name('edit_news');
    Route::post('/update_news', [NewsController::class, 'update_news'])->name('update_news');
    Route::get('/delete_news/{id}', [NewsController::class, 'delete_news'])->name('delete_news');
    // Item Category Routes
    Route::post('/get_category_detail' ,  [ItemCategoryController::class, 'get_category_detail'])->name('get_category_detail');
    Route::get('/item_category_list' ,  [ItemCategoryController::class, 'item_category_list'])->name('item_category_list');
    Route::get('/add_item_category', [ItemCategoryController::class, 'add_item_category'])->name('add_item_category');
    Route::post('/create_item_category', [ItemCategoryController::class, 'create_item_category'])->name('create_item_category');
    Route::get('/edit_item_category/{id}', [ItemCategoryController::class, 'edit_item_category'])->name('edit_item_category');
    Route::post('/update_item_category', [ItemCategoryController::class, 'update_item_category'])->name('update_item_category');
    Route::get('/delete_item_category/{id}', [ItemCategoryController::class, 'delete_item_category'])->name('delete_item_category');
    // Item Elements Routes
    Route::post('/get_element_detail' ,  [ItemElementController::class, 'get_element_detail'])->name('get_element_detail');
    Route::get('/item_element_list' ,  [ItemElementController::class, 'item_element_list'])->name('item_element_list');
    Route::get('/add_item_element', [ItemElementController::class, 'add_item_element'])->name('add_item_element');
    Route::post('/create_item_element', [ItemElementController::class, 'create_item_element'])->name('create_item_element');
    Route::get('/edit_item_element/{id}', [ItemElementController::class, 'edit_item_element'])->name('edit_item_element');
    Route::post('/update_item_element', [ItemElementController::class, 'update_item_element'])->name('update_item_element');
    Route::get('/delete_item_element/{id}', [ItemElementController::class, 'delete_item_element'])->name('delete_item_element');
    // Item Elements Value Routes
    Route::get('/item_element_value_list/{id}' ,  [ItemElementController::class, 'item_element_value_list'])->name('item_element_value_list');
    Route::get('/add_item_element_value/{id}', [ItemElementController::class, 'add_item_element_value'])->name('add_item_element_value');
    Route::post('/create_item_element_value', [ItemElementController::class, 'create_item_element_value'])->name('create_item_element_value');
    Route::get('/edit_item_element_value/{id}', [ItemElementController::class, 'edit_item_element_value'])->name('edit_item_element_value');
    Route::post('/update_item_element_value', [ItemElementController::class, 'update_item_element_value'])->name('update_item_element_value');
    Route::get('/delete_item_element_value/{id}/{parent}', [ItemElementController::class, 'delete_item_element_value'])->name('delete_item_element_value');
    // Item Routes
    Route::post('item_delete', [ItemController::class, 'item_delete'])->name('item_delete');
    Route::get('/item_list' ,  [ItemController::class, 'item_list'])->name('item_list');
    Route::get('/add_item', [ItemController::class, 'add_item'])->name('add_item');
    Route::post('/create_item', [ItemController::class, 'create_item'])->name('create_item');
    Route::get('/edit_item/{id}', [ItemController::class, 'edit_item'])->name('edit_item');
    Route::post('/update_item', [ItemController::class, 'update_item'])->name('update_item');
    Route::get('/delete_item/{id}', [ItemController::class, 'delete_item'])->name('delete_item');
    
    // Admin Msg Routes
    Route::get('/admin_msg_list', [AdminNotificationController::class, 'admin_msg_list'])->name('admin_msg_list');
    Route::get('/create_group', [AdminNotificationController::class, 'create_group'])->name('create_group');
    Route::get('/show_group', [AdminNotificationController::class, 'show_group'])->name('show_group');
    Route::get('/view_group/{id}', [AdminNotificationController::class, 'view_group'])->name('view_group');
    Route::get('/notif_list', [AdminNotificationController::class, 'notif_list'])->name('notif_list');
     Route::get('/delivery_new_notifications', [AdminNotificationController::class, 'delivery_new_notifications'])->name('delivery_new_notifications');
    Route::get('/event_new_notifications', [AdminNotificationController::class, 'event_new_notifications'])->name('event_new_notifications');
    Route::get('/booking_new_notifications', [AdminNotificationController::class, 'booking_new_notifications'])->name('booking_new_notifications');
    Route::get('/store_new_notifications', [AdminNotificationController::class, 'store_new_notifications'])->name('store_new_notifications');
    Route::get('/dj_new_notifications', [AdminNotificationController::class, 'dj_new_notifications'])->name('dj_new_notifications');
    Route::get('/delivery_all_notifications', [AdminNotificationController::class, 'delivery_all_notifications'])->name('delivery_all_notifications');
    Route::get('/event_all_notifications', [AdminNotificationController::class, 'event_all_notifications'])->name('event_all_notifications');
    Route::get('/booking_all_notifications', [AdminNotificationController::class, 'booking_all_notifications'])->name('booking_all_notifications');
    Route::get('/store_all_notifications', [AdminNotificationController::class, 'store_all_notifications'])->name('store_all_notifications');
    Route::get('/dj_all_notifications', [AdminNotificationController::class, 'dj_all_notifications'])->name('dj_all_notifications');
    Route::get('/add_admin_msg', [AdminNotificationController::class, 'add_admin_msg'])->name('add_admin_msg');
    Route::post('/create_dj_admin_group', [AdminNotificationController::class, 'create_dj_admin_group'])->name('create_dj_admin_group');
    Route::post('/create_admin_group', [AdminNotificationController::class, 'create_admin_group'])->name('create_admin_group');
    Route::post('/create_admin_msg', [AdminNotificationController::class, 'create_admin_msg'])->name('create_admin_msg');
    Route::post('/create_dj_admin_msg', [AdminNotificationController::class, 'create_dj_admin_msg'])->name('create_dj_admin_msg');
    Route::get('/delete_admin_msg/{id}', [AdminNotificationController::class, 'delete_admin_msg'])->name('delete_admin_msg');
    // Splash Routes
    Route::get('/splash_list' ,  [SplashController::class, 'splash_list'])->name('splash_list');
    Route::get('/add_new_splash', [SplashController::class, 'add_new_splash'])->name('add_new_splash');
    Route::post('/create_splash', [SplashController::class, 'create_splash'])->name('create_splash');
    Route::get('/edit_splash/{id}', [SplashController::class, 'edit_splash'])->name('edit_splash');
    Route::post('/update_splash', [SplashController::class, 'update_splash'])->name('update_splash');
    Route::get('/delete_splash/{id}', [SplashController::class, 'delete_splash'])->name('delete_splash');
    
    // Vip Pkg Routes
    Route::get('/vip_pkg_list' ,  [VipPkgController::class, 'vip_pkg_list'])->name('vip_pkg_list');
    Route::get('/add_new_vip_pkg', [VipPkgController::class, 'add_new_vip_pkg'])->name('add_new_vip_pkg');
    Route::post('/create_vip_pkg', [VipPkgController::class, 'create_vip_pkg'])->name('create_vip_pkg');
    Route::get('/edit_vip_pkg/{id}', [VipPkgController::class, 'edit_vip_pkg'])->name('edit_vip_pkg');
    Route::post('/update_vip_pkg', [VipPkgController::class, 'update_vip_pkg'])->name('update_vip_pkg');
    Route::get('/delete_vip_pkg/{id}', [VipPkgController::class, 'delete_vip_pkg'])->name('delete_vip_pkg');
    
    Route::get('/vip_booking_list' ,  [VipPkgController::class, 'vip_booking_list'])->name('vip_booking_list');
    Route::get('/delete_vip_booking/{id}', [VipPkgController::class, 'delete_vip_booking'])->name('delete_vip_booking');
    
    // DJ Questionnaire Routes
    Route::get('/dj_questionnaire', [DJQuestionnaireController::class, 'dj_questionnaire_list'])->name('dj_questionnaire');
    Route::post('question_delete', [DJQuestionnaireController::class, 'question_delete'])->name('question_delete');
    // Route::get('/dj_questionnaire_list' ,  [DJQuestionnaireController::class, 'dj_questionnaire_list'])->name('dj_questionnaire_list');
    Route::get('/add_new_dj_questionnaire', [DJQuestionnaireController::class, 'add_new_dj_questionnaire'])->name('add_new_dj_questionnaire');
    Route::get('/delete_dj_questionnaire/{id}', [DJQuestionnaireController::class, 'delete_dj_questionnaire'])->name('delete_dj_questionnaire');
    Route::post('/create_dj_questionnaire',[DJQuestionnaireController::class, 'create_dj_questionnaire'])->name('create_dj_questionnaire');
    Route::get('/edit_dj_questionnaire/{id}', [DJQuestionnaireController::class, 'edit_dj_questionnaire'])->name('edit_dj_questionnaire');
    Route::post('/dj_questionnaire_update', [DJQuestionnaireController::class, 'dj_questionnaire_update'])->name('dj_questionnaire_update');
    Route::get('/view_dj_questionnaire_questions/{id}', [DJQuestionnaireController::class, 'view_dj_questionnaire_questions'])->name('view_dj_questionnaire_questions');
    Route::get('/add_new_dj_questionnaire_question/{id}', [DJQuestionnaireController::class, 'add_new_dj_questionnaire_question'])->name('add_new_dj_questionnaire_question');
    Route::post('/create_dj_questionnaire_question',[DJQuestionnaireController::class, 'create_dj_questionnaire_question'])->name('create_dj_questionnaire_question');
    Route::get('/edit_dj_questionnaire_question/{id}', [DJQuestionnaireController::class, 'edit_dj_questionnaire_question'])->name('edit_dj_questionnaire_question');
    Route::get('/delete_dj_questionnaire_question/{id}', [DJQuestionnaireController::class, 'delete_dj_questionnaire_question'])->name('delete_dj_questionnaire_question');
    Route::post('/update_dj_questionnaire_question', [DJQuestionnaireController::class, 'update_dj_questionnaire_question'])->name('update_dj_questionnaire_question');
    Route::get('/view_dj_questionnaire_answers/{id}', [DJQuestionnaireController::class, 'view_dj_questionnaire_answers'])->name('view_dj_questionnaire_answers');
    Route::get('/add_new_dj_questionnaire_answer/{id}', [DJQuestionnaireController::class, 'add_new_dj_questionnaire_answer'])->name('add_new_dj_questionnaire_answer');
    Route::post('/create_dj_questionnaire_answer',[DJQuestionnaireController::class, 'create_dj_questionnaire_answer']);
    Route::get('/edit_dj_questionnaire_answer/{id}', [DJQuestionnaireController::class, 'edit_dj_questionnaire_answer'])->name('edit_dj_questionnaire_answer');
    Route::post('/update_dj_questionnaire_answer', [DJQuestionnaireController::class, 'update_dj_questionnaire_answer'])->name('update_dj_questionnaire_answer');    
}
    
);
Route::get('/', [WebsiteController::class, 'get_data'])->name('home');
Route::get('/homepage', [WebsiteController::class, 'get_data_homepage'])->name('homepage');
Route::get('/about-us', [WebsiteController::class, 'get_about_us'])->name('about-us');
Route::get('/book-event', [WebsiteController::class, 'get_book_event'])->name('book-event');
Route::get('/register_success', [WebsiteController::class, 'register_success'])->name('register_success');
Route::get('/contact-us', [WebsiteController::class, 'get_contact_us'])->name('contact-us');
Route::post('/web_registration', [WebsiteController::class, 'web_registration'])->name('web_registration');
Route::post('/web_email_verify', [WebsiteController::class, 'web_email_verify'])->name('web_email_verify');
Route::post('/otpSuccess', [WebsiteController::class, 'otpSuccess'])->name('otpSuccess');
Route::get('/resend_otp', [WebsiteController::class, 'resend_otp'])->name('resend_otp');


Route::get('/register', [WebsiteController::class, 'register'])->name('register');
Route::get('/event-page', [WebsiteController::class, 'get_event_page'])->name('event-page');
Route::get('/gallery1', [WebsiteController::class, 'get_gallery1'])->name('gallery1');
Route::get('/club', [WebsiteController::class, 'get_club'])->name('club_special');
Route::get('/privacy_policy', [WebsiteController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms', [WebsiteController::class, 'terms'])->name('terms');

Route::get('/booth', [WebsiteController::class, 'get_booth'])->name('booth');
Route::get('/gallery', [WebsiteController::class, 'get_gallery'])->name('gallery');
Route::get('/club_events', [WebsiteController::class, 'get_clubevent'])->name('club_events');
Route::any('/search',function(){
    $q = Request::get ( 'q' );
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(7);
    $event_data = Event::whereBetween('event_date', [$startDate, $endDate])->get();
    $event = Event::where('event_name','LIKE','%'.$q.'%')->orWhere('event_date','LIKE','%'.$q.'%')->get();
    // echo json_encode($event);die();
    if(count($event) > 0)
        return view('event-page',['event_list'=>$event,]);
    else return view ('event-page',['event_list'=>$event_data,'q' => $q]);
   
});

Route::get('/show-map',[DashboardController::class,'showMap'])->name('show-map');



