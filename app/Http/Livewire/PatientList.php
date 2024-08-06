<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patient;

class PatientList extends Component
{
    use WithPagination;

    public $search = '';
    public $gender = '';
    public $country = '';
    public $sortBy = 'first_name';
    public $sortDirection = 'asc';

    protected $updatesQueryString = ['search', 'gender', 'country', 'sortBy', 'sortDirection'];

    public function mount()
    {
        $this->fill(request()->only('search', 'gender', 'country', 'sortBy', 'sortDirection'));
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
return view('livewire.patient-list', ['patients' => $patients])
        ->extends('layouts.app');
    }
}