<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="search" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Search patients...">
        </div>
        <div class="col-md-3">
            <select wire:model.change="gender" class="form-control">
                <option value="">All Genders</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model.change="country" class="form-control">
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
                <th wire:key="firstName_header" wire:click.prevent="sortBy('first_name')" style="cursor: pointer;">
                    First Name
                    <span class="float-right">
                        <i class="fa fa-arrow-up {{ $sortByVariable === 'first_name' && $sortDirection === 'asc' ? '' : 'text-muted'}}" ></i>
                        <i class="fa fa-arrow-down {{ $sortByVariable === 'first_name' && $sortDirection === 'desc' ? '' : 'text-muted'}}" ></i>
                    </span>

                </th>
                <th wire:click="sortBy('last_name')" style="cursor: pointer;">
                    Last Name
                    <span class="float-right">
                        <i class="fa fa-arrow-up {{ $sortByVariable === 'last_name' && $sortDirection === 'asc' ? '' : 'text-muted'}}" ></i>
                        <i class="fa fa-arrow-down {{ $sortByVariable === 'last_name' && $sortDirection === 'desc' ? '' : 'text-muted'}}" ></i>
                    </span>
                </th>
                <th>Email</th>
                <th>Gender</th>
                <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                    Updated At
                    <span class="float-right">
                        <i class="fa fa-arrow-up {{ $sortByVariable === 'updated_at' && $sortDirection === 'asc' ? '' : 'text-muted'}}" ></i>
                        <i class="fa fa-arrow-down {{ $sortByVariable === 'updated_at' && $sortDirection === 'desc' ? '' : 'text-muted'}}" ></i>
                    </span>
                </th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr wire:key="patient-{{ $patient->first_name }}">
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