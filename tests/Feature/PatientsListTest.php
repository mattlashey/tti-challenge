<?php

use App\Livewire\Patient\PatientsList;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('can sort patients by birth date', function () {
    $patients = Patient::factory()->count(10)->create();

    Livewire::test(PatientsList::class)
        ->call('sortTable', 'birth_date')
        ->assertSeeInOrder($patients->sortBy('birth_date')->pluck('birth_date')->toArray())
        ->call('sortTable', 'birth_date', 'desc')
        ->assertSeeInOrder($patients->sortByDesc('birth_date')->pluck('birth_date')->toArray());
});
