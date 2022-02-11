<?php
Route::get('/', "TaskController@index")->name('task.list');
Route::get("/task/create", "TaskController@create")->name('task.create');
Route::post("/task", "TaskController@store");
Route::get("/{id}/complete", "TaskController@complete");
Route::get("/{id}/delete", "TaskController@destroy")->name('task.destory');
