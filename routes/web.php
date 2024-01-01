<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/article', [ArticleController::class, 'index']);

Route::get('/article/detail/{id}', [ArticleController::class, 'detail']);
Route::get('/article/delete/{id}', [ArticleController::class, 'delete']);

Route::get('/article/add', [ArticleController::class, 'add']);//button click with get method, to show the template. Default method in data transition is GET.
Route::post('/article/add', [ArticleController::class, 'create']);//firm submit with post method, to manipulate data with create method

Route::post('/comment/add', [CommentController::class, 'addComment']);
Route::get('/comment/delete/{id}', [CommentController::class, 'delete']);

Route::get('/', [ArticleController::class, 'index']);

Route::get('/article/update/{id}', [ArticleController::class, 'edit']);
Route::post('/article/update/{id}', [ArticleController::class, 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
