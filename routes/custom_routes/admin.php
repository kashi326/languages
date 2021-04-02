<?php


Route::group(['prefix'=>"admin",'namespace'=>"admin",'middleware'=>"CheckForAdmin"],function(){
    Route::get('/',"AdminController@index")->name('admin.index');

    // languages
    Route::resource("lang","LanguageController",['as'=>'admin']);

    // users
    Route::get('/user',"UserController@index")->name('admin.user.index');
    Route::post('/user/search',"UserController@search")->name('admin.user.search');
    Route::post('/user/restore',"UserController@restore")->name('admin.user.restore');
    Route::delete('/user/{user}',"UserController@destroy")->name('admin.user.destroy');
//Lessons
    Route::get('lesson','TeacherController@lesson')->name('admin.lesson');
    Route::get('lesson/view/{lesson}','TeacherController@lessonView')->name('admin.lesson.view');
    Route::get('lesson/homework','TeacherController@homework')->name('admin.lesson.homework');
    Route::get('lesson/homework/download/{type}/{id}','TeacherController@download')->name('admin.homework.download');
    Route::get('decks','DeckController@index')->name('admin.decks');
    Route::get('decks/view/{id}','DeckController@show')->name('admin.deck.view');
    // teacher
    include_once("admin/teacher.php");

    //settings
    Route::get('setting/subjects',"SettingController@getSubject")->name('admin.setting.subject');
    Route::put('setting/subjects',"SettingController@destroySubject")->name('admin.setting.subject.destroy');
    Route::post('setting/subjects','SettingController@createSubject')->name('admin.setting.subject.create');

    Route::get('setting/TestPreparation','SettingController@getTestPreparation')->name('admin.setting.testpreparation');
    Route::put('setting/TestPreparation','SettingController@destroyTestPreparation')->name('admin.setting.testpreparation.destroy');
    Route::post('setting/TestPreparation','SettingController@createTestPreparation')->name('admin.setting.testpreparation.create');

    Route::get('setting/teachesto','SettingController@getTeachesTo')->name('admin.setting.to');
    Route::put('setting/teachesto','SettingController@destroyTeachesTo')->name('admin.setting.to.destroy');
    Route::post('setting/teachesto','SettingController@createTeachesTo')->name('admin.setting.to.create');

    Route::get('setting/teachinglevel','SettingController@getTeachingLevel')->name('admin.setting.level');
    Route::put('setting/teachinglevel','SettingController@destroyTeachingLevel')->name('admin.setting.level.destroy');
    Route::post('setting/teachinglevel','SettingController@createTeachingLevel')->name('admin.setting.level.create');

    Route::get('setting/lessoninclude','SettingController@getLessonInclude')->name('admin.setting.include');
    Route::put('setting/lessoninclude','SettingController@destroyLessonInclude')->name('admin.setting.include.destroy');
    Route::post('setting/lessoninclude','SettingController@createLessonInclude')->name('admin.setting.include.create');

    Route::get('/privacy-policy',"SettingController@privacy")->name("admin.privacy.edit");
    Route::post('/privacy-policy/update',"SettingController@updateprivacy")->name("admin.privacy.update");
    Route::post('/privacy-policy/add',"SettingController@addprivacy")->name("admin.privacy.add");
    Route::post('/privacy-policy/delete',"SettingController@deleteprivacy")->name("admin.privacy.delete");

});
?>
