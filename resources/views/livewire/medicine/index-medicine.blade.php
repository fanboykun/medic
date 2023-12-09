<div>
    <x-slot name="header">
        Medicines
    </x-slot>
    <section class="h-full">
        <x-table-content>
            <x-slot name="table_header" >
                <x-table-header ddFilter=true>
                    <x-slot name="search">
                        <x-search>
                            <x-slot name="input">
                                <x-search-input wire:model.live.debounce.500ms="search" placeholder="Search by medicine name"/>
                            </x-slot>
                        </x-search>
                    </x-slot>
                    <x-slot name="main_button">
                        <x-primary-link href="{{ route('purchases.create')}}" wire:navigate class="w-full">
                            <x-icons.plus />
                            Add New
                        </x-primary-link>
                    </x-slot>

                    <x-slot name="actions">
                        {{-- <x-primary-link href="{{ route('purchases.create')}}" wire:navigate>
                            <x-icons.plus />
                            Add New
                        </x-primary-link> --}}
                       <div x-data="{
                            a : $wire.get('filter_expired'),
                            dd : false,
                            filtered : false,
                            openDd() {
                                this.dd = true
                            },
                            setUnitVal(id) {
                                $wire.set('filter_unit', id)
                                id == '' ? this.filtered = false : this.filtered = true
                                this.dd = false
                            },
                            setCatVal(id) {
                                $wire.set('filter_category', id)
                                id == '' ? this.filtered = false : this.filtered = true
                                this.dd = false
                            },
                            setExpVal(tf) {
                                $wire.set('filter_expired', tf)
                                this.dd = false
                                console.log($wire.get('filter_expired'))
                            },
                            clearFilter() {
                                $wire.set('filter_unit', '')
                                $wire.set('filter_category', '')
                                $wire.set('filter_expired', '')
                                this.filtered = false
                            },
                        }"
                        >
                             <button x-on:click="openDd" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <svg class="w-4 h-4 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                  </svg>
                                Filter
                            </button>

                            <div x-data="{ showChild : 0 }" x-on:mouseleave="showChild = 0">
                                <!-- Dropdown menu -->
                                <div x-cloak x-show="dd == true" x-on:click.outside="dd = false" class="z-10 absolute flex flex-row mt-2 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow min-w-[150px] dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                                        <li x-show="filtered == true" class="w-full">
                                            <button type="button" x-on:click="clearFilter" class="flex w-full px-4 py-2  border border-red-200 hover:bg-red-200 text-red-600 rounded-md">
                                                Reset Filter
                                            </button>
                                        </li>
                                        <li x-on:mouseover="showChild = 1" class="w-full relative group">
                                            <button type="button" x-on:click="showChild = 1" class="flex items-center justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="h-[18px] w-[18px] transition-all group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                               <span>Filter Unit</span>
                                            </button>
                                            <div x-cloak x-show="showChild == 1" class="absolute flex flex-row z-[9999] min-w-[200px] max-h-[150px] sm:max-h-[300px] overflow-y-auto bg-white dark:bg-gray-700 top-0 rounded-lg shadow-md border-2 border-indigo-500" style="transform: translateX(calc(-100%))">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                                                    @foreach ($units as $unit)
                                                    <li class="w-full">
                                                        <button type="button" x-on:click="setUnitVal({{ $unit->id }})" class="flex items-center justify-between w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            {{ $unit->name }}
                                                            @if($filter_unit === $unit->id)
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                            </svg>
                                                            @endif
                                                        </button>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li x-on:mouseover="showChild = 2" class="w-full relative group">
                                            <button type="button" x-on:click="showChild = 1" class="flex items-center justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="h-[18px] w-[18px] transition-all group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                               <span>Filter Category</span>
                                            </button>
                                            <div x-cloak x-show="showChild == 2" class="absolute flex flex-row z-[9999] min-w-[200px] max-h-[150px] sm:max-h-[300px] overflow-y-auto bg-white dark:bg-gray-700 top-0 rounded-lg shadow-md border-2 border-indigo-500" style="transform: translateX(calc(-100%))">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                                                    @foreach ($categories as $category)
                                                    <li class="w-full">
                                                        <button type="button" x-on:click="setCatVal({{ $category->id }})" class="flex items-center justify-center w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            {{ $category->name }}
                                                            @if($filter_category === $category->id)
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                            </svg>
                                                            @endif
                                                        </button>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li x-on:mouseover="showChild = 3" class="w-full relative group">
                                            <button type="button" class="flex items-center justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="h-[18px] w-[18px] transition-all group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                               <span>Filter Expired</span>
                                            </button>
                                            <div x-cloak x-show="showChild == 3" class="absolute flex flex-row z-[9999] w-full max-h-[150px] sm:max-h-[300px] overflow-y-auto bg-white dark:bg-gray-700 top-0 rounded-lg shadow-md border-2 border-indigo-500" style="transform: translateX(calc(-100%))">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                                                    <li class="w-full">
                                                        <button type="button" x-on:click="setExpVal(1)" class="flex items-center justify-center w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Expired
                                                            @if($filter_expired != null && $filter_expired == true)
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                              </svg>
                                                              @endif
                                                        </button>
                                                    </li>
                                                    <li class="w-full">
                                                        <button type="button" x-on:click="setExpVal(0)" class="flex items-center justify-center w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Not Expired
                                                            @if($filter_expired != null && $filter_expired == false)
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                              </svg>
                                                            @endif
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                       </div>
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
            <div id="destroy-medicine" @submit.prevent="show = false">
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
            </div>
        </x-modal>
    </section>
</div>
