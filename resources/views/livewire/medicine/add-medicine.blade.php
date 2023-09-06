<div>
    <section class="bg-white dark:bg-gray-900 rounded-lg">
        <div class="py-8 px-4 mx-auto w-full lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Medicine</h2>
            <form wire:submit.prevent="saveMedicine">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name <span class="text-red-500">*</span> </label>
                        <input type="text" wire:model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Medicine Name" required="">
                        @error('name')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock <span class="text-red-500">*</span></label>
                        <input type="number" wire:model="stock" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="1" required="">
                    </div>
                    <div>
                        <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit <span class="text-red-500">*</span></label>
                        <div class="flex">
                            <select wire:model="unit_id" id="unit_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select Unit</option>
                                @forelse ($units as $unit)

                                <option value="{{$unit->id}}"> {{$unit->name}} </option>

                                @empty
                                No data!
                                @endforelse
                            </select>
                            <button x-on:click="$dispatch('open-modal', 'add-unit')" class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                  </svg>

                            </button>
                        </div>
                        @error('unit_id')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category <span class="text-red-500">*</span></label>
                        <div class="flex">
                            <select wire:model="category_id" id="category_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                @forelse ($categories as $category)

                                <option value="{{$category->id}}"> {{$category->name}} </option>

                                @empty
                                No data!
                                @endforelse
                            </select>
                            <button class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                  </svg>

                            </button>
                        </div>
                        @error('category_id')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier <span class="text-red-500">*</span></label>
                        <div class="flex">
                            <select wire:model="supplier_id" id="supplier_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select Supplier</option>
                                @forelse ($suppliers as $supplier)

                                <option value="{{$supplier->id}}"> {{$supplier->name}} </option>

                                @empty
                                No data!
                                @endforelse
                            </select>
                            <button class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                  </svg>

                            </button>
                        </div>
                        @error('supplier_id')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                            </div>
                            <input type="number" wire:model="purchase_price" id="purchase_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        @error('purchase_price')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                            </div>
                            <input type="number" wire:model="selling_price" id="selling_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        @error('selling_price')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="expired" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired <span class="text-red-500">*</span></label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input type="date" wire:model="expired" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                        @error('expired')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="storage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage</label>
                        <input type="text" wire:model="storage" name="storage" id="storage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input storage" required="">
                        @error('storage')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" wire:model="description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input description" required="">
                        @error('description')
                        <span class="block text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-end justify-end">
                    <button type="submit" class="inline-flex mx-2 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">
                        Add product
                    </button>
                    <x-secondary-button class="py-3 mx-1" wire:click="clearForm">
                        Clear
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </section>
    <x-modal x-data name="add-unit" focusable>
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-4 rounded-xl item-center justify-center">
                Add Unit Form
            </div>
            <form class="p-4" wire:submit="saveUnit" @submit.prevent="show = false">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="name" wire:model="unitName" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of The Unit <span class="text-xs font-light text-red-500">*</span>
                    </label>
                    @error('unitName')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="flex justify-end">
                    <x-secondary-button class="mx-4 px-5 py-2.5 capitalize" x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <button type="submit" wire:submit.attr="disabled" wire:target="saveUnit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
