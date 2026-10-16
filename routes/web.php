<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clinics', function () {
    return view('clinics');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::redirect('/conditions', '/services#conditions');
Route::redirect('/patient-resources', '/services#patient-resources');

Route::get('/services/orthopedics', function () {
    return view('orthopedics');
});

Route::get('/services/general-surgery', function () {
    return view('general-surgery');
});

// Service, condition and patient-resource pages from resources/data/services.
Route::get('/{section}/{slug}', [ServiceController::class, 'show'])
    ->whereIn('section', ['services', 'conditions', 'patient-resources'])
    ->where('slug', '[a-z0-9-]+')
    ->name('catalog.show');
