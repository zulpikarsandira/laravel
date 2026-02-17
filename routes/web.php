<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-vercel', function () {
    return response()->json([
    'status' => 'OK',
    'message' => 'NG-LOCO Vercel Debugger',
    'session_driver' => config('session.driver'),
    'cache_store' => config('cache.default'),
    'storage_path' => storage_path(),
    'database_path' => config('database.connections.sqlite.database'),
    ]);
});