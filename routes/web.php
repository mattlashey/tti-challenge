<?php

use App\Livewire\PatientDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home-dashboard');
});

