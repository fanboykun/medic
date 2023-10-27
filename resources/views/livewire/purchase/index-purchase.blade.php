<div>
    <x-slot name="header">
        Purchases
    </x-slot>

    <div class="flex flex-col pt-4 px-4 rounded-lg md:flex-row items-center dark:bg-gray-800 justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.500ms="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Search by invoice" required="">
                </div>
            </form>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <a href="{{ route('purchases.create')}}" wire:navigate class="flex items-center justify-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                <svg  class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add Purchase
            </a>
        </div>
    </div>

    <div class="mt-2 relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="min-h-[75vh] max-h-[80vh]">
            <table class=" w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                </thead>
                <tbody>
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
                                <a href="/" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button wire:click="deletePurchase({{ $purchase }})" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class=" col-span-8 items-center justify-center">No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <nav class="flex flex-col items-start justify-between p-4 bg-white dark:bg-gray-700  space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-200">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $purchases?->count() }}</span>
                    dari
                    <span class="font-semibold text-gray-900 dark:text-gray-50">{{ $purchases?->total() }}</span>
                </span>
                <button type="button" wire:click="loadMore()" class="text-sm font-normal text-indigo-600 dark:text-indigo-400">
                    Muat Lebih ...
                </button>
            </nav>
        </div>
    </div>

    <x-modal name="purchase-medicine-detail">
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-4 rounded-xl item-center justify-center">
                <div class="block">
                    <p>Detail Purchase Medicine</p>
                    <p>ID : {{ $selectedPurchase?->id }}| Invoice : {{ $selectedPurchase?->invoice }}</p>
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
                    Cancel
                </x-secondary-button>
            </div>
        </div>
    </x-modal>

    <x-modal name="delete-purchase" focusable>
        <form id="destroy-category" @submit.prevent="show = false">
            <div class="p-6 dark:bg-gray-900">
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
        </form>
    </x-modal>

</div>
