<?php

use App\Http\Controllers\Scrapper\ScrapperController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('scrapper');
// });

Route::get("/", [ScrapperController::class, "index",])->name('index');
