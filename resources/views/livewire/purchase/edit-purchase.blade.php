<div>
    <x-slot name="header">
        Edit Purchase
    </x-slot>

    <section class="bg-white dark:bg-gray-800 rounded-lg">

        <div x-data="{
                currentTab: 'purchase_form',
                async changeTab(tab){
                    this.currentTab = tab
                    await $wire.clearFormAfterChangeTab()
                },
                init() {
                    if($wire.get('medicine_query_exists') == true) {
                        this.currentTab = 'medicine_form'
                    }
                }
            }"
            x-on:set-tab.window="changeTab($event.detail)"
            >
            <!-- Tabs -->
            <div class="flex justify-center text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 dark:bg-slate-900">
                <ul class="flex flex-wrap -mb-px">
                    <li class="mr-2">
                        <button x-on:click="await changeTab('purchase_form')" :class="currentTab == 'purchase_form' ? 'text-blue-600 border-blue-600  dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-block p-4 border-b-2 rounded-t-lg transition-all duration-200 ease-linear">Purchase Form</button>
                    </li>
                    <li x-cloak x-show="currentTab == 'medicine_form'" class="mr-2">
                        <button disabled x-on:click="await changeTab('medicine_form')" :class="currentTab == 'medicine_form' ? 'text-blue-600 border-blue-600  dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'" class="inline-block p-4 border-b-2 rounded-t-lg disabled:opacity-70 transition-all duration-200 ease-linear">Medicines Form</button>
                    </li>
                </ul>
            </div>

            <!-- Purchase Form -->
            <div x-show="currentTab == 'purchase_form'"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                class="py-4 px-4 mx-auto w-full lg:py-8 bg-gray-50 dark:bg-inherit">
                    <div class="pb-8">
                        <div class="flex justify-between items-center pb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Purchase Data</h2>
                            <button type="submit" wire:click="updatePurchase()" wire:loading.attr="disabled" wire:loading.class="bg-indigo-400 opacity-50" wire:target="appendNewPurchase" class="inline-flex mx-2 items-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">
                                Update Purchase Data
                            </button>
                        </div>
                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-2 lg:gap-6 p-4 bg-white dark:bg-slate-900 rounded-xl">
                            <div>
                                <label for="purchase_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Date <span class="text-red-500">*</span></label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input type="date" wire:model="purchaseForm.purchase_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required>
                                </div>
                                @error('purchaseForm.purchase_date')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier <span class="text-red-500">*</span></label>
                                <div class="flex">
                                    <select wire:model="purchaseForm.supplier_id" required id="purchaseForm.supplier_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled >Select Supplier</option>
                                        @forelse ($suppliers as $supplier)

                                        <option value="{{$supplier->id}}"> {{$supplier->name}} </option>

                                        @empty
                                        No data!
                                        @endforelse
                                    </select>
                                    {{-- <button x-on:click="$dispatch('open-modal', 'add-supplier')" class="flex bg-indigo-600 hover:bg-indigo-800 text-white rounded-lg px-2 py-1 text-sm ml-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                        </svg>

                                    </button> --}}
                                </div>
                                @error('purchaseForm.supplier_id')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="total_purchase" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Purchase (filled automatically)<span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                                    </div>
                                    <input type="number" wire:model="purchaseForm.total_purchase" disabled id="total_purchase" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                            </div>
                            <div>
                                <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Invoice (filled automatically) <span class="text-red-500">*</span></label>
                                <div class="flex">
                                    <input type="text" wire:model="purchaseForm.invoice" disabled name="invoice" id="invoice" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="invoice will be filled after purchase created" required="">
                                </div>
                                <span class="block text-gray-500 text-xs text-end pt-0.5">click regenerate invoice code button if invoice code alaready exist</span>
                                @error('purchaseForm.invoice')
                                <span class="block text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="total_medicine" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Medicine(s) (filled automatically)<span class="text-red-500">*</span></label>
                                <input type="text" wire:model="total_medicine" disabled name="total_medicine" id="total_medicine" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="will be filled after purchase created" required="">
                            </div>
                            <div class="w-full">
                                <label for="total_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Quantities (filled automatically)<span class="text-red-500">*</span></label>
                                <input type="number" wire:model="total_quantity" disabled name="total_quantity" id="total_quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="will be filled after purchase created" required="">
                            </div>
                        </div>
                    </div>
                    <div class="flex my-4 w-full bg-gray-200 dark:bg-gray-500 h-[2px]"></div>
                    <div class="pt-8">
                        <div class="flex justify-between items-center pb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Medicine Data</h2>
                            <button type="button" wire:click="addNewMedicine()" wire:loading.attr="disabled" wire:loading.class="bg-indigo-400 opacity-50" wire:target="addNewMedicine" class="inline-flex mx-2 items-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">
                                Add New Medicine
                            </button>
                        </div>
                        <div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
                            <div class=" max-h-[80vh]">
                                <table class=" w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3"> Name </th>
                                            <th scope="col" class="px-6 py-3"> Quantity </th>
                                            <th scope="col" class="px-6 py-3"> Expired</th>
                                            <th scope="col" class="px-6 py-3"> Purchase Price</th>
                                            <th scope="col" class="px-6 py-3"> Selling Price</th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($purchase_medicine as $k => $medicine)
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                    <td class="px-6 py-4">{{ $medicine['name'] }}</td>
                                                    <td class="px-6 py-4">{{ $medicine['pivot']['quantity'] }}</td>
                                                    <td class="px-6 py-4">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $medicine['expired'])->format('d M Y') }}</td>
                                                    <td class="px-6 py-4">Rp {{number_format($medicine['purchase_price'], 0, ',','.')}}</td>
                                                    <td class="px-6 py-4">Rp {{number_format($medicine['selling_price'], 0, ',','.')}}</td>
                                                <td class="px-6 py-4">
                                                    <button wire:click="editMedicine({{ $medicine['id'] }})" wire:loading.attr="disabled" wire:loading.class="text-indigo-400 opacity-50" wire:target="editMedicine" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                                    <button wire:click="deleteMedicine({{ $medicine['id'] }})" wire:loading.attr="disabled" wire:loading.class="text-indigo-400 opacity-50" wire:target="deleteMedicine" type="button" class="block font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td>No Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Medicine Form -->
            <div x-cloak x-show="currentTab == 'medicine_form'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                class="py-4 px-4 mx-auto w-full lg:py-8 bg-gray-50 dark:bg-inherit translate-y-0">
                    <div>
                        <div class="flex justify-between items-center pb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Medicine Form</h2>
                        </div>

                        <div class="grid gap-y-2 bg-white dark:bg-slate-900 p-4  rounded-xl">
                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-6 ">

                                <div class="lg:col-span-2 col-span-3">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name <span class="text-red-500">*</span> </label>
                                    <input type="text" wire:model="medicineForm.name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Medicine Name" required="">
                                    @error('medicineForm.name')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock <span class="text-red-500">*</span></label>
                                    <input type="number" wire:model="medicineForm.stock" min="1" minlength="1" max="9999" maxlength="4" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input stock with min value is 1" required="">
                                    @error('medicineForm.stock')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- @if($medicine_form_mode == 'add')
                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier <span class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <select wire:model="medicineForm.supplier_id" required id="supplier_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" disabled>Select Supplier</option>
                                            @forelse ($suppliers as $supplier)

                                            <option value="{{$supplier->id}}"> {{$supplier->name}} </option>

                                            @empty
                                            No data!
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('medicineForm.unit_id')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif --}}

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit <span class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <select wire:model="medicineForm.unit_id" required id="unit_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" disabled>Select Unit</option>
                                            @forelse ($units as $unit)

                                            <option value="{{$unit->id}}"> {{$unit->name}} </option>

                                            @empty
                                            No data!
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('medicineForm.unit_id')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category <span class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <select wire:model="medicineForm.category_id" required id="category_id" class="flex w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" disabled>Select category</option>
                                            @forelse ($categories as $category)

                                            <option value="{{$category->id}}"> {{$category->name}} </option>

                                            @empty
                                            No data!
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('medicineForm.category_id')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                                        </div>
                                        <input type="number" wire:model="medicineForm.purchase_price" id="purchase_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                    </div>
                                    @error('medicineForm.purchase_price')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="w-4 text-gray-500 dark:text-gray-400">Rp.</span>
                                        </div>
                                        <input type="number" wire:model="medicineForm.selling_price" id="selling_price" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                    </div>
                                    @error('medicineForm.selling_price')
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
                                        <input type="date" wire:model="medicineForm.expired" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required>
                                    </div>
                                    @error('medicineForm.expired')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full lg:col-span-1 col-span-3">
                                    <label for="storage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage</label>
                                    <input type="text" wire:model="medicineForm.storage" name="storage" id="storage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input storage">
                                    @error('medicineForm.storage')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full {{ $medicine_form_mode == 'add' ?  'col-span-2' : 'col-span-3'}}">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <input type="text" wire:model="medicineForm.description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="input description">
                                    @error('medicineForm.description')
                                    <span class="block text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <div>
                                    @if($medicine_form_mode == 'edit')
                                        <button type="submit" wire:click="updateMedicine()" wire:loading.attr="disabled" wire:loading.class="bg-indigo-400 opacity-50" wire:target="updateMedicine" class="inline-flex mx-2 items-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800"> Update Medicine </button>
                                    @elseif($medicine_form_mode == 'add')
                                        <button type="submit" wire:click="saveNewMedicine()" wire:loading.attr="disabled" wire:loading.class="bg-indigo-400 opacity-50" wire:target="saveNewMedicine" class="inline-flex mx-2 items-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 hover:bg-indigo-800"> Save Medicine </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>

    </section>

    {{-- <x-modal x-data name="add-unit" focusable>
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-2 rounded-xl item-center justify-center">
                Add Unit Form
            </div>
            <div class="py-2 mt-4">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="unitName" id="unitName" wire:model="unitName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
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
                    <button type="submit" wire:loading.attr="disabled" wire:target="saveUnit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </x-modal>
    <x-modal x-data name="add-category" focusable>
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-2 rounded-xl item-center justify-center">
                Add Category Form
            </div>
            <div class="py-2 mt-4">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="categoryName" id="categoryName" wire:model="categoryName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of The Category <span class="text-xs font-light text-red-500">*</span>
                    </label>
                    @error('categoryName')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="description" id="description" wire:model="categoryDescription" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description Category</label>
                    @error('categoryDescription')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="flex justify-end">
                    <x-secondary-button class="mx-4 px-5 py-2.5 capitalize" x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <button type="submit" wire:submit.attr="disabled" wire:target="saveCategory" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </x-modal>
    <x-modal x-data name="add-supplier" focusable>
        <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg py-2 px-4 h-fit">
            <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-2 rounded-xl item-center justify-center">
                Add Supplier Form
            </div>
            <div class="py-2 mt-4">
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="supplierName" id="supplierName" wire:model="supplierName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of The Supplier <span class="text-xs font-light text-red-500">*</span>
                    </label>
                    @error('supplierName')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="text" name="description" id="description" wire:model="supplierAddress" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>
                    @error('supplierAddress')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group p-2">
                    <input type="number" name="description" id="description" wire:model="supplierPhone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                    @error('supplierPhone')
                    <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div class="flex justify-end">
                    <x-secondary-button class="mx-4 px-5 py-2.5 capitalize" x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <button type="submit" wire:submit.attr="disabled" wire:target="saveSupplier" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </x-modal> --}}
</div>
