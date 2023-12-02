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
                    <x-select-input wire:model.live.debounce.500ms="filter_unit">
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
                    </x-select-input>
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
