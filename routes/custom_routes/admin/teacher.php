<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/teacher/payment/{id}', 'TeacherController@payment')->name('admin.teacher.payment');
Route::get('/admin/teacher/payment/history/{id}', 'TeacherController@paymentHistory')->name('admin.teacher.payment.history');
Route::post('/admin/teacher/payment/{id}', 'TeacherController@createPayment')->name('admin.teacher.payment.create');
Route::resource("teacher", "TeacherController", [
    'as' => "admin"
]);
?>
