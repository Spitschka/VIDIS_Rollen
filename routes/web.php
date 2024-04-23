<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/issue', [\App\Http\Controllers\IssueController::class, 'index'])->name('issue.index');
Route::post('/issue', [\App\Http\Controllers\IssueController::class, 'issue'])->name('issue.create');

Route::get('/qr/{data}', [\App\Http\Controllers\QRController::class, 'verify'])->name('qr.verify');
Route::get("/qr/{data}/image", [\App\Http\Controllers\QRController::class, 'getQRCodeImage'])->name('qr.image');

Route::get('/upload', [\App\Http\Controllers\UploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload.upload');

Route::get("/test", [\App\Http\Controllers\TestController::class, 'index'])->name('test.index');
