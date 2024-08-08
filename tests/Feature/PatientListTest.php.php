<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Patient;
use Livewire\Livewire;

class PatientListTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    /** @test */
    public function it_shows_patients()
    {
        // Arrange: create some patients
        Patient::factory()->count(3)->create();

        // Act: visit the livewire component
        $response = $this->get('/patients');

        // Assert: the patients are visible on the page
        $response->assertSee(Patient::all()->pluck('first_name')->toArray());
    }

    /** @test */
    public function it_searches_patients()
    {
        // Arrange: create some patients
        Patient::factory()->create(['first_name' => 'Joseph']);
        Patient::factory()->create(['first_name' => 'James']);

        // Act: search for a patient
        Livewire::test('patient-list')
            ->set('search', 'Joseph')
            ->assertSee('Joseph')
            ->assertDontSee('James');
    }

    /** @test */
    public function it_sorts_patients_by_first_name()
    {
        // Arrange: create some patients
        Patient::factory()->create(['first_name' => 'Joseph']);
        Patient::factory()->create(['first_name' => 'James']);

        // Act: sort by first name
        Livewire::test('patient-list')
            ->set('sortByVariable', 'first_name')
            ->set('sortDirection', 'asc')
            ->assertSeeInOrder([
                'James', 
                'Joseph',
            ]);
    }

    /** @test */
    public function it_paginates_patients()
    {
        // Arrange: create some patients
        Patient::factory()->count(20)->create();

        // Act: visit the livewire component
        Livewire::test('patient-list')
            ->assertSee('Prev')
            ->assertSee('Next');
    }
}