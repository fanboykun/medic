<div>
    <x-slot name="header">
        Purchases
    </x-slot>

    <x-table-content>
        <x-slot name="table_header">
            <x-table-header ddFilter=true>
                <x-slot name="search">
                    <x-search>
                        <x-slot name="input">
                            <x-search-input wire:model.live.debounce.500ms="search" placeholder="Search by purchase invoice name"/>
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
                   <div x-data="toggleFilter" >
                         <button x-on:click="openDd" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                           <x-icons.filter />
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
                                            <x-icons.caret />
                                            <span>Filter Supplier</span>
                                        </button>
                                        <div x-cloak x-show="showChild == 1" class="absolute flex flex-row z-[9999] min-w-[200px] max-h-[150px] sm:max-h-[300px] overflow-y-auto bg-white dark:bg-gray-700 top-0 rounded-lg shadow-md border-2 border-indigo-500 translate-x-[-25%] translate-y-[30%] sm:translate-y-[0%] sm:translate-x-[-100%]" >
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                                                @foreach ($suppliers as $supplier)
                                                <li class="w-full">
                                                    <button type="button" x-on:click="setSupplierVal({{ $supplier->id }})" class="flex items-center justify-between w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ $supplier->name }}
                                                        @if($filter_supplier === $supplier->id)
                                                        <x-icons.check />
                                                        @endif
                                                    </button>
                                                </li>
                                                @endforeach
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
                <th scope="col" class="px-6 py-3"> Invoice</th>
                <th scope="col" class="px-6 py-3"> Supplier</th>
                <th scope="col" class="px-6 py-3"> Purchase Date</th>
                <th scope="col" class="px-6 py-3"> Total Purchase</th>
                <th scope="col" class="px-6 py-3"> Medicines</th>
                <th scope="col" class="px-6 py-3"> Last Update</th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($purchases as $purchase)
            <tr wire:key="{{ $purchase->id }}" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="px-6 py-4"> {{ $purchase->id }} </td>
                <td class="px-6 py-4">{{ $purchase->invoice }}</td>
                <td class="px-6 py-4">{{ $purchase->supplier->name }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $purchase->purchase_date)->format('d M Y')}}</td>
                <td class="px-6 py-4">Rp {{number_format($purchase->total_purchase, 0, ',','.')}}</td>
                <td class="px-6 py-4"><button wire:click="openPurchaseMedicine({{ $purchase }})" class="text-green-400">Details</button></td>
                <td class="px-6 py-4">{{ $purchase->updated_at->diffForHumans() }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('purchases.edit', $purchase->id) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <button wire:click="deletePurchase({{ $purchase->id }})" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                </td>
            </tr>
            @empty
            <tr>
                <td class=" col-span-8 items-center justify-center">No Data</td>
            </tr>
            @endforelse
        </x-slot>
        <x-slot name="table_navigation">
            <x-table-navigation>
                <x-slot name="nav_info">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-200">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $purchases?->count() }}</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $purchases?->total() }}</span>
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

    <x-modal name="purchase-medicine-detail">
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex flex-col items-center justify-center bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-4 rounded-xl">
                <p class="underline decoration decoration-wavy decoration-indigo-500 font-extrabold">Purchase Medicine Detail</p>
                <div class="flex w-full px-6 justify-between items-center">
                    <p class="font-bold">Purchase ID : <span class="font-normal"> {{ $selectedPurchase?->id }} </span></p>
                    <p class="font-bold"> Invoice : <span class="font-normal"> {{ $selectedPurchase?->invoice }}</span></p>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Medicine Id</th>
                        <th scope="col" class="px-6 py-3"> Medicine Name</th>
                        <th scope="col" class="px-6 py-3"> Quantity</th>
                        <th scope="col" class="px-6 py-3"> Purchase Price</th>
                        <th scope="col" class="px-6 py-3"> Created at</th>
                        <th scope="col" class="px-6 py-3"> </th>
                    </tr>
                </thead>
                @if($selectedPurchase != null)
                    <tbody>
                        @forelse($selectedPurchase->medicines as $medicine)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="px-6 py-4"> {{ $medicine->id }} </td>
                            <td class="px-6 py-4">{{ $medicine->name }}</td>
                            <td class="px-6 py-4">{{ $medicine->pivot->quantity }}</td>
                            <td class="px-6 py-4">Rp {{number_format($medicine->pivot->purchase_price, 0, ',','.')}}</td>
                            <td class="px-6 py-4">{{ $medicine->pivot->created_at->format('d M Y')}}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('medicines.edit', $medicine->id) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            No Data
                        </tr>
                        @endforelse
                    </tbody>
                @endif
            </table>
            <div class="flex justify-end mt-4 mb-2">
                <x-secondary-button class="mx-4 px-5 py-2.5 capitalize" x-on:click="$dispatch('close')">
                    Close
                </x-secondary-button>
            </div>
        </div>
    </x-modal>

    <x-modal name="delete-purchase" focusable>
        <div>
            <div class="p-6 dark:bg-gray-900" x-on:close-modal.window="show = false">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                    Are you sure you want to delete this purchase
                    <div>
                        <span class="font-bold underline"> Invoice : {{ $selectedPurchase ? $selectedPurchase->invoice : '' }} </span>
                    </div>
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    This purchase may have data related to it, once the purchase deleted, all the data that related to it will be impacted.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3" type="submit" wire:click="destroyPurchase" wire:submit.attr="disabled" wire:target="destroyPurchase">
                        {{ __('Delete Purchase') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </x-modal>

    @script
        <script>
            Alpine.data('toggleFilter', () => ({
                dd : false,
                filtered : false,
                openDd() {
                    this.dd = true
                },
                setSupplierVal(id) {
                    $wire.set('filter_supplier', id)
                    id == '' ? this.filtered = false : this.filtered = true
                    this.dd = false
                },
                clearFilter() {
                    $wire.set('filter_supplier', '')
                    this.filtered = false
                    this.dd = false
                },
            }))
        </script>
    @endscript

</div>
