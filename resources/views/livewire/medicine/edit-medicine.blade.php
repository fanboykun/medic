<div>
    <x-slot name="header">
        Edit Medicine
    </x-slot>

    <section class="bg-white dark:bg-gray-900 rounded-lg">

        <div>

            <!-- Medicine Form -->
            <div class="py-8 px-4 mx-auto w-full lg:py-8">
                <div>
                    <div class=" flex justify-between items-center">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Medicine Form</h2>
                    </div>

                    <form wire:submit="updateMedicine" class="grid gap-y-4">
                        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-6 dark:bg-slate-800 px-2 py-4">
                            <div class="lg:col-span-2 col-span-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name <span class="text-red-500">*</span> </label>
                                <input type="text" wire:model="form.name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Medicine Name" required>
                                @error('form.name')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock <span class="text-red-500">*</span></label>
                                <input readonly disabled type="number" wire:model="form.stock" min="1" minlength="1" max="9999" maxlength="4" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input stock with min value is 1" required="">
                                <span class="block text-gray-500 text-sm">not allowed to edit the stock data</span>
                                @error('form.stock')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="lg:col-span-1 col-span-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier <span class="text-red-500">*</span> </label>
                                <input readonly disabled type="text" value="{{ $form->supplier_name }}" name="supplier_id" id="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Medicine Name" required="">
                                <span class="block text-gray-500 text-sm">not allowed to edit the supplier data</span>
                                @error('form.supplier_id')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit <span class="text-red-500">*</span></label>
                                <div class="flex">
                                    <select wire:model="form.unit_id" required id="form.unit_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled>Select Unit</option>
                                        @forelse ($units as $unit)

                                        <option value="{{ $unit->id }}" wire:key="{{ $unit->id }}" {{ $unit->id == $form->unit_id ? 'selected' : ''  }}> {{ $unit->name }} </option>

                                        @empty
                                        No data!
                                        @endforelse
                                    </select>
                                    <button x-on:click="$dispatch('open-modal', 'add-unit')" type="button" class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                          </svg>

                                    </button>
                                </div>
                                @error('form.unit_id')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category <span class="text-red-500">*</span></label>
                                <div class="flex">
                                    <select wire:model="form.category_id" required id="form.category_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled>Select category</option>
                                        @forelse ($categories as $category)

                                        <option value="{{ $category->id }}" wire:key="{{ $category->id }}" {{ $category->id == $form->category_id ? 'selected' : ''  }} > {{ $category->name }} </option>

                                        @empty
                                        No data!
                                        @endforelse
                                    </select>
                                    <button x-on:click="$dispatch('open-modal', 'add-category')" type="button" class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                          </svg>
                                    </button>
                                </div>
                                @error('form.category_id')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div class="w-full lg:col-span-1 col-span-3">

                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                                    </div>
                                    <input readonly disabled type="number" wire:model="form.purchase_price" id="purchase_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                                <span class="block text-gray-500 text-sm">not allowed to edit the purchase price data</span>
                                @error('form.purchase_price')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                                    </div>
                                    <input readonly disabled type="number" wire:model="form.selling_price" id="selling_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                                <span class="block text-gray-500 text-sm">not allowed to edit the selling price data</span>
                                @error('form.selling_price')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="expired" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired <span class="text-red-500">*</span></label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input type="date" wire:model="form.expired" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required>
                                </div>
                                @error('form.expired')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-1 col-span-3">
                                <label for="storage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage</label>
                                <input type="text" wire:model="form.storage" name="storage" id="storage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input storage">
                                @error('form.storage')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full lg:col-span-2 col-span-3">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input type="text" wire:model="form.description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input description">
                                @error('form.description')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-end justify-end">
                            <div>
                                <button type="submit" wire:loading.attr="disabled" wire:loading.class="bg-indigo-400 opacity-50" wire:target="appendNewMedicine" class="inline-flex mx-2 items-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">
                                    Update Medicine
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>

</div>
