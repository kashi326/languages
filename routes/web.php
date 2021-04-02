<?php

use App\Http\Controllers\GiftsController;
use App\Http\Controllers\SettingController;
use App\Language;
use Illuminate\Support\Facades\Route;

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

include_once("custom_routes/admin.php");

Route::get('/', "WelcomeController@index")->name('main');
Route::get('lang/{locale}', 'WelcomeController@lang');
Route::get('/privacy-policy','HomeController@privacypolicy')->name('privacy');
Auth::routes(['verify' => true]);
Route::resource('findteacher', 'FindTeacherController');
Route::get('/view/{id}/{name}','FindTeacherController@profile')->name('view.teacher');


Route::middleware(['auth'])->group(function () {
    //dashboard routes
    Route::get('/dashboard', 'DashboardController@index')->name("dashboard");
    Route::get('/buy','GiftsController@buy');
    Route::get('/checkout','GiftsController@checkout');
    Route::get('/dashboard/lessons', 'DashboardController@lessons');
    Route::get('/dashboard/homework', 'DashboardController@homework');
    Route::get('/dashboard/myteachers', 'DashboardController@myteachers');
    Route::get('/dashboard/vocabulary', 'DashboardController@vocabulary');
    //vote routes && get vote route is defined for testing purpose ignore
    Route::get('vote', function () {
        return redirect()->back();
    });
    Route::post('vote', 'DiscussionController@vote');
    Route::post('/payments/completed', 'PaymentController@completed')->name('payment.completed');
    Route::get('/payments/success', 'PaymentController@success')->name('payment.success');

    Route::resource('payments', 'PaymentController');
    //discussion routes
    Route::post('/discussion/sortby', 'DiscussionController@sortBy');
    Route::resource('discussion', 'DiscussionController');
    Route::get('newdiscussion', function () {
        $languages = Language::select('id', 'name')->get();
        return view('discussions.newdiscussion')->with('languages', $languages);
    });
    //lessons routes
    Route::get('lessons/view/{id}','LessonsController@index');
    Route::get('lessons/reschedule/{id}','LessonsController@reschedule')->name('lesson.reschedule');
    Route::get('lessons/destroy/{id}','LessonsController@destroy');
    Route::post("/lesson/feedback","LessonsController@feedback")->name('lesson.feedback.submit');
    Route::post("/lesson/reschedule","LessonsController@updateReschudle")->name('lesson.reschedule.update');
    Route::get('/homework/download/{id}','LessonsController@download')->name('homework.download');
    Route::post('/homework/response','LessonsController@response')->name('homework.response');
    //settings routes
    Route::get('/setting','SettingController@index')->name('setting.profile.get');
    Route::post('/setting','SettingController@updateProfile')->name('setting.profile.post');
    Route::get('/setting/profilepicture','SettingController@getProfilePicture')->name('setting.profile.picture.get');
    Route::post('/setting/profilepicture','SettingController@updateProfilePicture')->name('setting.profile.picture.post');
    Route::get('/setting/languages','SettingController@getLanguages')->name('setting.language.get');
    Route::post('/setting/languages','SettingController@updateLanguages')->name('setting.language.post');
    Route::get('/setting/password','SettingController@getPassword')->name('setting.password.get');
    Route::post('/setting/password','SettingController@updatePassword')->name('setting.password.post');
    Route::get('/setting/notification','SettingController@getNotification')->name('setting.notification.get');
    Route::get('/setting/payments','SettingController@getPayments')->name('setting.payments.get');
    Route::post('/setting/speak/add','SettingController@addSpeak')->name('setting.language.speak.add');
    Route::get('/setting/deactivate','SettingController@getUser')->name('setting.user.get');
    Route::post('/setting/deactivate','SettingController@destroyUser')->name("setting.user.deactivate");
    //Gifts Route
    // Route::resource('gifts','GiftsController');
    // EnterPrise routes
    // Route::resource('enterprise', 'EnterpriseController');
    //Decks
    Route::get('/decks','DeckController@index')->name('decks');
    Route::get('/decks/view/{id}','DeckController@show')->name('decks.view');

    //Feature Request
    Route::post("/feature/vote",'FeatureRequestController@vote')->name('feature.vote');
    Route::get("/admin/feature",'FeatureRequestController@adminindex')->middleware('CheckForAdmin')->name('admin.feature.index');
    Route::resource('feature','FeatureRequestController');

    // User Speaks
    Route::get('/language/speaks/{id}','SettingController@deletelanguage')->name("language.speaks.delete");
    Route::put('/language/speaks/level','SettingController@updatelevel')->name("language.speaks.level");
    Route::put('/language/speaks/motivation','SettingController@updatemotivation')->name("language.speaks.motivation");
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => "auth"], function () {
    include_once("custom_routes/teach.php");
});
