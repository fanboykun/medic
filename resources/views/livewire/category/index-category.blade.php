<div>
    <x-slot name="header">
        Categories
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-2 sm:gap-x-2">
        <div class="col-span-2 bg-white dark:bg-gray-800 rounded-lg">

            <div class="relative w-full py-3 mb-1 px-2 rounded-md dark:bg-gray-900">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.500ms="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Search category by name" required="">
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg min-h-fit max-h-[70vh] overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Category Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               <a href="" class="hover:underline underline-offset-2 decoration-slate-100 decoration-1">{{ $category->name }}</a>
                            </th>
                            <td class="px-6 py-4">
                                <button type="button" wire:click="editCategory({{ $category }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                <button wire:click="deleteCategory({{ $category }})" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <div>
                            No Data
                        </div>
                        @endforelse
                    </tbody>
                </table>
                <div class="relative overflow-hidden bg-white rounded-b-lg shadow-md dark:bg-gray-800">
                    <nav class="flex flex-col items-start justify-between p-4 bg-white dark:bg-gray-700  space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-200">
                            Menampilkan
                            <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $categories?->count() }}</span>
                            dari
                            <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $categories?->total() }}</span>
                        </span>
                        <button type="button" wire:click="loadMore()" class="text-sm font-normal text-indigo-600 dark:text-indigo-400">
                            Muat Lebih ...
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <div class="sm:order-last order-first bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg w-full sm:py-2 sm:px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-4 rounded-xl item-center justify-center">
                Add Category Form
            </div>
            <form class="p-4" wire:submit="saveCategory">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="name" wire:model="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of The Category <span class="text-xs font-light text-red-500">*</span>
                    </label>
                    @error('name')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="description" wire:model="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description Category</label>
                    @error('description')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="flex">
                    <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="saveCategory">
                        Clear
                    </x-secondary-button>
                    <button type="submit" wire:submit.attr="disabled" wire:target="saveCategory" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <x-modal x-data name="edit-category" focusable>
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-4 rounded-xl item-center justify-center">
                Edit Category Form
            </div>
            <form class="p-4" wire:submit="updateCategory" @submit.prevent="show = false">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="name" wire:model="selectedCategory.name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of The Category <span class="text-xs font-light text-red-500">*</span>
                    </label>
                    @error('selectedCategory.name')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="description" id="description" wire:model="selectedCategory.description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description Category</label>
                    @error('selectedCategory.description')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="flex justify-end">
                    <x-secondary-button class="mx-4 px-5 py-2.5 capitalize" x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <button type="submit" wire:submit.attr="disabled" wire:target="updateCategory" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="delete-category" focusable>
        <form id="destroy-category" @submit.prevent="show = false">
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
        </form>
    </x-modal>

</div>
