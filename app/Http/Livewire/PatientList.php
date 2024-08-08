<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patient;

class PatientList extends Component
{
    public $users;
    use WithPagination;

    public $search = '';
    public $gender = '';
    public $country = '';
    public $sortByVariable = 'first_name';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->fill(request()->only('search', 'gender', 'country', 'sortByVariable', 'sortDirection'));
    }

    public function sortBy($field)
    {
        if ($this->sortByVariable === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortByVariable = $field;
    }

    //Livewire hook to update the search variable on change/update 
    public function updateSearch()
    {
        $this->reset($this->search);
        $this->goToPage(1);
    }

    public function render()
    {
        $patients = Patient::query()
            ->when($this->search, function($query) {
                return $query->where('first_name', 'like', '%' . $this->search . '%')
                             ->orWhere('last_name', 'like', '%' . $this->search . '%')
                             ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->gender, function($query) {
                return $query->where('gender', $this->gender);
            })
            ->when($this->country, function($query) {
                return $query->where('country', $this->country);
            })
            ->orderBy($this->sortByVariable, $this->sortDirection)
            ->paginate(10);
        return view('livewire.patient-list', ['patients' => $patients])
        ->extends('components.layouts.app');
    }
}