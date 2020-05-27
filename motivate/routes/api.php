<?php

use Illuminate\Http\Request;

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

Route::get('/projects/user/{id}', 'ProjectsController@projectsByUser');
Route::get('/projects/progress/{id}', 'ProjectsController@projectProgress');
Route::resource('/projects', 'ProjectsController', [
    'except' => ['create']
]);
Route::get('/sections/project/{id}', 'SectionsController@sectionsByProject');
Route::get('/sections/progress/{id}', 'SectionsController@sectionProgress');
Route::resource('/sections', 'SectionsController', [
    'except' => ['index']
]);
Route::get('/tasks/section/{id}', 'TasksController@tasksBySection');
Route::get('/tasks/project/{id}', 'TasksController@tasksByProject');
Route::get('/tasks/user/{id}', 'TasksController@tasksByUser');
Route::resource('/tasks', 'TasksController', [
    'except' => ['index']
]);