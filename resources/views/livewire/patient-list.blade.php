<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search patients...">
        </div>
        <div class="col-md-3">
            <select wire:model="gender" class="form-control">
                <option value="">All Genders</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model="country" class="form-control">
                <option value="">All Countries</option>
                @foreach ($patients->pluck('country')->unique() as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th wire:click="sortBy('first_name')" style="cursor: pointer;" class="w-25 p-3">
                    First Name
                    @if($sortBy === 'first_name')
                    <span wire:click="sortBy('first_name')" class="float-right">
                        <i class="fa fa-arrow-up text-muted" ></i>
                        <i class="fa fa-arrow-down" ></i>
                    </span>
                        <!-- <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i> -->
                    @endif
                </th>
                <th wire:click="sortBy('last_name')" style="cursor: pointer;">
                    Last Name
                    @if($sortBy === 'last_name')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </th>
                <th>Email</th>
                <th>Gender</th>
                <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                    Updated At
                    @if($sortBy === 'updated_at')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr>
                    <td>{{ $patient->first_name }}</td>
                    <td>{{ $patient->last_name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->updated_at }}</td>
                    <td>{{ $patient->country }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $patients->links('pagination::bootstrap-4') }}
</div>