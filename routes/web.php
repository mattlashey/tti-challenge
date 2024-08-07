<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PatientList;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/patients', PatientList::class);

