<div>
    <x-slot name="header">
        Medicines
    </x-slot>
    <x-table-content>
        <x-slot name="table_header" >
            <x-table-header>
                <x-slot name="search">
                    <div class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.500ms="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Search" required="">
                        </div>
                    </div>
                </x-slot>
                <x-slot name="main_button">
                    <a href="{{ route('purchases.create')}}" wire:navigate class="flex items-center justify-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New
                    </a>
                </x-slot>
                <x-slot name="actions">
                    <select wire:model.live.debounce.500ms="filter_unit" class="py-2 px-2 w-fit text-sm dark:bg-gray-700 dark:text-white rounded-full">
                        <option value=""> Filter Unit </option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->name }} </option>
                        @endforeach
                    </select>
                    <select wire:model.live.debounce.500ms="filter_category" class="py-2 px-2 text-sm dark:bg-gray-700 dark:text-white rounded-full">
                        <option value=""> Filter Category </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                    <select wire:model.live.debounce.500ms="filter_expired" class="py-2 text-sm dark:bg-gray-700 dark:text-white rounded-full">
                        <option value=""> Filter Expired </option>
                        <option value="1"> Expired </option>
                        <option value="0"> Not Expired </option>
                    </select>
                </x-slot>
            </x-table-header>
        </x-slot>
        <x-slot name="th">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3"> Name</th>
                <th scope="col" class="px-6 py-3"> Stock</th>
                <th scope="col" class="px-6 py-3"> Unit</th>
                <th scope="col" class="px-6 py-3"> Category</th>
                <th scope="col" class="px-6 py-3"> Expired</th>
                <th scope="col" class="px-6 py-3"> Purchase Price</th>
                <th scope="col" class="px-6 py-3"> Selling Price</th>
                <th scope="col" class="px-6 py-3"> Supplier</th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($medicines as $medicine)
                <tr wire:key="{{ $medicine->id }}" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4"> {{ $medicine->id }} </td>
                    <td class="px-6 py-4">{{ $medicine->name }}</td>
                    <td class="px-6 py-4">{{ $medicine->stock }}</td>
                    <td class="px-6 py-4">{{ $medicine->unit->name}}</td>
                    <td class="px-6 py-4">{{ $medicine->category->name}}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $medicine->expired)->format('d M Y') }}</td>
                    <td class="px-6 py-4">Rp {{number_format($medicine->purchase_price, 0, ',','.')}}</td>
                    <td class="px-6 py-4">Rp {{number_format($medicine->selling_price, 0, ',','.')}}</td>
                    <td class="px-6 py-4">{{ $medicine->supplier->name}}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('medicines.show', ['medicine' => $medicine ]) }}" wire:navigate class="block font-medium text-green-600 dark:text-green-400 hover:underline">Details</a>
                        <a href="{{ route('medicines.edit', $medicine->id) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <button wire:click="deleteMedicine({{ $medicine }})" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </td>
                </tr>
            @endforeach
        </x-slot>
        <x-slot name="table_navigation">
            <x-table-navigation>
                <x-slot name="nav_info">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-200">
                        Menampilkan
                        <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $medicines?->count() }}</span>
                        dari
                        <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $medicines?->total() }}</span>
                    </span>
                    </x-slot>
                <x-slot name="nav_link">
                    <button type="button" wire:click="loadMore()" class="text-sm font-normal text-indigo-600 dark:text-indigo-400">
                        Muat Lebih ...
                    </button>
                </x-slot>
            </x-table-navigation>
        </x-slot>
    </x-table-content>
    <x-modal name="delete-medicine" focusable>
        <form id="destroy-medicine" @submit.prevent="show = false">
            <div class="p-6 dark:bg-gray-900">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                    Are you sure you want to delete <span class="font-bold underline"> {{ $selectedMedicine ? $selectedMedicine['name'] : 'this' }} </span> medicine?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    This category may have data related to it, once the category deleted, all the data that related to it will be impacted.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3" type="submit" wire:click="destroyMedicine" wire:submit.attr="disabled" wire:target="destroyMedicine">
                        {{ __('Delete Medicine') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal>
</div>
