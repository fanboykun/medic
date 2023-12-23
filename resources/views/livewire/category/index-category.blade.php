<div>
    <x-slot name="header">
        Categories
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-y-2 sm:gap-x-2">
        <div class="col-span-2 bg-white dark:bg-gray-800 rounded-lg">
            <x-table-content>
                <x-slot name="table_header">
                    <x-table-header searchOnly=true>
                        <x-slot name="search">
                            <x-search smbtn=true>
                                <x-slot name="input">
                                    <x-search-input wire:model.live.debounce.500ms="search" placeholder="Search by medicine name"/>
                                </x-slot>
                                <x-slot name="btn">
                                    <x-secondary-button x-on:click="$dispatch('open-modal', 'add-category')">Add New</x-secondary-button>
                                </x-slot>
                            </x-search>
                        </x-slot>
                        <div class="flex lg:hidden items-center justify-end py-3 px-2 whitespace-nowrap ">
                            <x-secondary-button x-on:click="$dispatch('open-modal', 'add-category')">Add New</x-secondary-button>
                        </div>
                    </x-table-header>
                </x-slot>
                <x-slot name="th">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Category Name
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
                    @forelse ($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ $category->name }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->created_at->format('d M Y') }}
                        </th>
                        <td class="px-6 py-4">
                            <a href="{{ route('categories.show', ['category' => $category ]) }}" wire:navigate class="block font-medium text-green-600 dark:text-green-400 hover:underline">Details</a>
                            {{-- <button type="button" wire:click="editCategory({{ $category }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button> --}}
                            <button type="button" x-on:click="$dispatch('open-edit-category-modal', {{ $category->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            <button wire:click="deleteCategory({{ $category }})" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
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
                                <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $categories?->count() }}</span>
                                of
                                <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $categories?->total() }}</span>
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
            <livewire:category.add-category />
        </div>
    </div>

    <x-modal x-data name="add-category" focusable>
       <livewire:category.add-category />
    </x-modal>

    <x-modal x-data name="edit-category" focusable>
        <livewire:category.edit-category  @category-updated.window="$refresh"/>
    </x-modal>

    <x-modal name="delete-category" focusable>
        <div id="destroy-category" x-on:close-modal.window="show = false">
            <div class="p-6 dark:bg-gray-900">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                    Are you sure you want to delete <span class="font-bold underline"> {{ $selectedCategory ? $selectedCategory['name'] : 'this' }} </span> category?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    This category may have data related to it, once the category deleted, all the data that related to it will be impacted.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3" type="submit" wire:click="destroyCategory" wire:submit.attr="disabled" wire:target="destroyCategory">
                        {{ __('Delete Category') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </x-modal>

</div>
