<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    //projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project_id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project_id}', [ProjectController::class, 'destroy']);

    //Tasks
    Route::get('/project/{project_id}/tasks', [TaskController::class, 'index']);
    Route::post('/project/{project_id}/tasks', [TaskController::class, 'store']);
    Route::put('/project/{project_id}/tasks/{task_id}', [TaskController::class, 'update']);
    Route::delete('/project/{project_id}/tasks/{task_id}', [TaskController::class, 'destroy']);

    //updating task status
    Route::put('project/tasks/{task_id}/status', [TaskController::class, 'updateStatus']);

    //add remarks
    Route::post('/project/tasks/{task_id}/remark', [TaskController::class, 'addRemark']);

    //project reports
    Route::get('/project/{project_id}/report', [ProjectController::class, 'projectReport']);
});
