<?php
Route::group(['prefix' => "teacher", "namespace" => "teach", 'middleware' => "PreventAdminFromTutor"], function () {
    Route::group(['middleware' => "PreventTeacherFromJoin"], function () {
        Route::get('/register', "IndexController@join")->name('teach.join');
        Route::post("/register", "IndexController@store")->name('teach.store');
    });
    Route::get("/lesson/record", "LessonController@record")->name('teach.lesson.record');
    Route::get("/lesson/record/{id?}", "LessonController@view")->name('teach.lesson.view');
    Route::post("/lesson/platform", "LessonController@platform")->name('teach.lesson.platform.update');
    Route::get('/lesson/homework/download/{id}', 'HomeworkController@download')->name('teach.homework.download');
    Route::post('/lesson/homework/store', 'HomeworkController@store')->name('teach.homework.upload');
    Route::get("/homework", "HomeworkController@index")->name('teach.homework.index');
    Route::Post("/homework", "HomeworkController@update")->name('teach.homework.index');
    Route::get("/homework", "HomeworkController@index")->name('teach.homework.index');
    Route::get("/update/profile", "IndexController@teachingProfile")->name('teach.profile.update');
    Route::post("/update/profile/{update}", "IndexController@updateTeachingProfile")->name('teach.profile.test');
    Route::post("/update/profile/timing/add", "IndexController@addTiming")->name('teach.profile.timing.add');
    Route::post("/update/profile/timing/delete", "IndexController@deleteTiming")->name('teach.profile.timing.delete');
    Route::resource('decks', 'DecksController');
    Route::resource('decksLesson', 'DeckLessonsController');
    Route::get('/meeting/{id}/{teacher}', "MeetingController@index")->name('teacher.meeting');
});
