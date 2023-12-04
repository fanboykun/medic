<div>
    <x-slot name="header">
        Medicines
    </x-slot>
    <x-table-content>
        <x-slot name="table_header" >
            <x-table-header>
                <x-slot name="search">
                    <x-search>
                        <x-slot name="input">
                            <x-search-input wire:model.live.debounce.500ms="search" placeholder="Search by medicine name"/>
                        </x-slot>
                    </x-search>
                </x-slot>
                <x-slot name="main_button">
                    <x-primary-link href="{{ route('purchases.create')}}" wire:navigate>
                        <x-icons.plus />
                        Add New
                    </x-primary-link>
                </x-slot>

                <x-slot name="actions">
                   <div x-data="{
                        dd : false,
                        filtered : false,
                        openDd() {
                            this.dd = true
                        },
                        setVal(id) {
                            $wire.set('filter_unit', id)
                            id == '' ? this.filtered = false : this.filtered = true
                            this.dd = false
                        }
                    }">

                        <button id="dropdownHoverButton" x-on:click="openDd" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Filter Unit
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownHover" x-cloak x-show="dd == true" x-on:click.outside="dd = false" class="z-10 absolute origin-top-right right-2 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow min-w-[150px] dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center" aria-labelledby="dropdownHoverButton">
                                <li x-show="filtered == true">
                                    <button type="button" x-on:click="setVal('')" class="flex w-full px-4 py-2  border border-red-200 hover:bg-red-200 text-red-600 rounded-md">
                                        Reset Filter
                                    </button>
                                </li>
                                @foreach ($units as $unit)
                                <li>
                                    <button type="button" x-on:click="setVal({{ $unit->id }})" class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ $unit->name }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                   </div>

                    {{-- <x-select-input wire:model.live.debounce.500ms="filter_unit">
                        <option value=""> Filter Unit </option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->name }} </option>
                        @endforeach
                    </x-select-input>
                    <x-select-input wire:model.live.debounce.500ms="filter_category">
                        <option value=""> Filter Category </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </x-select-input>
                    <x-select-input wire:model.live.debounce.500ms="filter_expired" class="w-full">
                        <option value=""> Filter Expired </option>
                        <option value="1"> Expired </option>
                        <option value="0"> Not Expired </option>
                    </x-select-input> --}}
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
