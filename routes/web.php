<?php

use Illuminate\Support\Facades\Route;

Route::get('/session', function(){
    return session()->all();
});

require __DIR__ . '/admin.php';
require __DIR__ . '/frontend.php';
