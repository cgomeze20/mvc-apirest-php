<?php

use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\UsuarioController;

//GET
Route::get("/", [HomeController::class, 'index']);
Route::get("/usuarios", [UsuarioController::class, "index"]);

//POST Usuario
Route::post("/crearusuario", [UsuarioController::class, 'save']);
Route::post("/eliminarusuario",[UsuarioController::class, "delete"]);
Route::post("/obtenerusuarios", [UsuarioController::class, "getAll"]);
Route::post("/obtenerusuario", [UsuarioController::class, "getOne"]);
Route::post("/actualizarusuario", [UsuarioController::class, 'update']);

Route::dispatch();