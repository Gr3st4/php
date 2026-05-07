<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productcontroller;

Route::get('/', function () {
return redirect()->route('product.index');
});

Route::resource('product', productcontroller::class);