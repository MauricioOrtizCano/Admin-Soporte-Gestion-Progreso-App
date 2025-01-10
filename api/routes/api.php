<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\supportcaseController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/users', [userController::class, 'getAllUsers']);


// Rutas para el CRUD de usuarios

// Route::get('/users', [userController::class, 'getUserPaginated']);

Route::get('/users-support-cases', [userController::class, 'getUserSupportCases']);

Route::get('/users/{id}', [userController::class, 'getUserById']);

Route::post('/users', [userController::class, 'createUser']);

Route::put('/users/{id}', [userController::class, 'updateUser']);

Route::delete('/users/{id}', [userController::class, 'deleteUser']);

Route::patch('/users/{id}', [userController::class, 'updatePartialUser']);



// Rutas para el CRUD de casos de soporte

Route::get('/support-cases', [supportcaseController::class, 'getAllSupportCases']);

Route::get('/support-cases/{id}', [supportcaseController::class, 'getOneSupportCase']);

Route::post('/support-cases', [supportcaseController::class, 'createSupportCase']);

Route::put('/support-cases/{id}', [supportcaseController::class, 'updatePartialSupportCase']);

Route::delete('/support-cases/{id}', [supportcaseController::class, 'deleteSupportCase']);



// Rutas para el CRUD de comentarios

Route::get('/comments', [commentController::class, 'getAllComments']);

Route::get('/comments/{id}', [commentController::class, 'getOneComment']);

Route::post('/comments', [commentController::class, 'createComment']);

Route::put('/comments/{id}', [commentController::class, 'updateComment']);

Route::delete('/comments/{id}', [commentController::class, 'deleteComment']);


