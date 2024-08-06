<?php

use App\Livewire\Patient\PatientsList;
use Illuminate\Support\Facades\Route;

Route::get('/', PatientsList::class);
