<div>
    <div class="dashboardFrame">
        <p class="title">Patient Dashboard</p>
        <div class="bg-white dark:bg-gray-800 sm:rounded-lg dashboardBody">
            <div class="flex items-center justify-between p-4">
                <div class="flex w-1/2"> 
                    <input class="mr-2" wire:model.live.debounce.300ms="searchName" type="text" placeholder="Search Name" required="">
                    <input class="ml-2 basicSearch" wire:model.live.debounce.300ms="searchEmail" type="text" placeholder="Search Email" required="">
                </div>
                <div class="flex">
                    <div class="flex items-center">
                        <label class="mr-1">Gender:</label>
                        <select wire:model.live='gender'>
                            <option value="">All</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                    <button class="resetBtn" alt="reset" wire:click="resetFilters">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>
                </div>
            </div>
            <div wire:ignore.self id="content" class="content" >
                <label class="mb-1" for="">Country</label>
                <input class="advancedSearch" wire:model.live.debounce.800ms="searchCountry" type="text" placeholder="Search Country" required="">
                <div class="flex mt-2">
                    <div class="w-1/2 mr-2">
                        <label class="mb-1" for="">DOB</label>
                        <div class="flex">
                            <input type="date" wire:model.live.debounce.1200ms = 'dobStartDate'
                            class="advancedSearch"
                            placeholder="Start" required="">
                            <input type="date" wire:model.live.debounce.1200ms = 'dobEndDate'
                            class="advancedSearch">
                        </div>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label for="">Member Since</label>
                        <div class="flex">
                            <input type="date" wire:model.live.debounce.1200ms = 'createdStartDate'
                            class="advancedSearch">
                            <input type="date" wire:model.live.debounce.1200ms = 'createdEndDate'
                            class="advancedSearch">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="shadow-xl shadow-sky-100 collapsible advancdeSearchBtn">Advanced Search 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            
            <div class="overflow-x-auto">
                <table>
                    <thead class="bg-gray-50">
                        <tr>
                        @include('livewire.includes.sort-th',[
                            'name' => 'first_name',
                            'displayName' => 'FIRST NAME'
                        ])
                        @include('livewire.includes.sort-th',[
                            'name' => 'last_name',
                            'displayName' => 'LAST NAME'
                        ])
                        @include('livewire.includes.sort-th',[
                            'name' => 'email',
                            'displayName' => 'EMAIL'
                        ])
                        <th>GENDER</th>
                            @include('livewire.includes.sort-th',[
                            'name' => 'birth_date',
                            'displayName' => 'DOB'
                        ])                
                        <th>COUNTRY</th>
                        @include('livewire.includes.sort-th',[
                            'name' => 'created_at',
                            'displayName' => 'MEMBER SINCE'
                        ])              </tr>
                    </thead>
                    <tbody>  
                        @foreach($patients as $patient)               
                            <tr>
                                <td class="firstName">{{$patient->first_name}}</td>
                                <td>{{$patient->last_name}}</td>
                                <td>{{$patient->email}}</td>
                                <td class=" text-center">{{$patient->gender}}</td>
                                <td>{{date('Y-m-d', strtotime($patient->birth_date))}}</td>
                                <td>{{$patient->country}}</td>
                                <td>{{date('Y-m-d', strtotime($patient->created_at))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('livewire.includes.pagination')
        </div>
    </div>
</div>

<script src="{{ asset('js/collapsible.js') }}"></script>