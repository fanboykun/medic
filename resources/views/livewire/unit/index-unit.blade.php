<div>
    <x-slot name="header">
        Units
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-y-2 sm:gap-x-2">
        <div class="col-span-2 bg-white dark:bg-gray-800 rounded-lg">

            <x-table-content>
                <x-slot name="table_header">
                    <x-table-header searchOnly=true>
                        <x-slot name="search">
                            <x-search smbtn=true>
                                <x-slot name="input">
                                    <x-search-input wire:model.live.debounce.500ms="search" placeholder="Search by unit name"/>
                                </x-slot>
                                <x-slot name="btn">
                                    <x-secondary-button x-on:click="$dispatch('open-modal', 'add-unit')">Add New</x-secondary-button>
                                </x-slot>
                            </x-search>
                        </x-slot>
                        <div class="flex lg:hidden items-center justify-end py-3 px-2 whitespace-nowrap ">
                            <x-secondary-button x-on:click="$dispatch('open-modal', 'add-unit')">Add New</x-secondary-button>
                        </div>
                    </x-table-header>
                </x-slot>
                <x-slot name="th">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Unit Name
                                <button wire:click="sortBy('name')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Created At
                                <button wire:click="sortBy('created_at')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($units as $unit)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">
                        {{ $unit->name }}
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">
                           {{ $unit->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4 items-center">
                                <a href="{{ route('units.show', ['unit' => $unit ]) }}" wire:navigate class="font-medium text-green-600 dark:text-green-400 hover:underline">Details</a>
                                <button type="button" x-on:click="$dispatch('open-edit-unit-modal', {{ $unit->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                <button wire:click="deleteUnit({{ $unit }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <div>
                        No Data
                    </div>
                    @endforelse
                </x-slot>
                <x-slot name="table_navigation">
                    <x-table-navigation>
                        <x-slot name="nav_info">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-200">
                                Showing
                                <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $units?->count() }}</span>
                                of
                                <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $units?->total() }}</span>
                            </span>
                        </x-slot>
                        <x-slot name="nav_link">
                            <button type="button" wire:click="loadMore()" class="text-sm font-normal text-indigo-600 dark:text-indigo-400">
                                Load More ...
                            </button>
                        </x-slot>
                    </x-table-navigation>
                </x-slot>
            </x-table-content>

        </div>

        <div class="sm:order-last order-first hidden lg:block ">
            <livewire:unit.add-unit />
        </div>
    </div>

    <x-modal x-data name="add-unit" focusable>
        <livewire:unit.add-unit />
    </x-modal>

    <x-modal x-data name="edit-unit" focusable>
        <livewire:unit.edit-unit  @unit-updated.window="$refresh"/>
    </x-modal>

    <x-modal name="delete-unit" focusable>
        <div id="destroy-unit" x-on:close-modal.window="show = false">
            <div class="p-6 dark:bg-gray-900">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                    Are you sure you want to delete <span class="font-bold underline"> {{ $selectedUnit ? $selectedUnit['name'] : 'this' }} </span> unit?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    This unit may have data related to it, once the unit deleted, all the data that related to it will be impacted.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3" type="submit" wire:click="destroyUnit" wire:submit.attr="disabled" wire:target="destroyUnit">
                        {{ __('Delete Unit') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </x-modal>

</div>
