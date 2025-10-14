<?php

use Illuminate\Support\Facades\Route;

Route::view('/admin/categories', 'admin.categories')->name('admin.categories');
Route::view('/about', 'about')->name('about');
