<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('/user', [UserController::class,'show']);
});

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/my-post', [UserController::class, 'getMyPosts']);

Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::get('/user-info', [PostController::class, 'index']); // Um einen neuen Benutzer zu speichern
Route::post('/user-info', [PostController::class, 'store']);
Route::get('/user', [UserController::class, 'show']);

