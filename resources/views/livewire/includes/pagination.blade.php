<div class="py-4 px-3">
    <div class="flex ">
        <div class="flex space-x-4 items-center mb-3">
            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
            <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " wire:model.live='perPage'>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    {{ $patients->links() }}
</div>