<div>
    <x-slot name="header">
        Detail Medicine
    </x-slot>
    <section class="bg-white dark:bg-gray-900 rounded-lg p-4">
        <div class="px-2">
          <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-200">{{ $medicine->name }} Detail</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 dark:text-gray-300">Contains all information about the medicine.</p>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
          <dl class="divide-y divide-gray-100 dark:divide-gray-800">
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->name }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Selling Price</dt>
              <div class="flex justify-between w-full sm:col-span-2 pr-2">
                <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:mt-0">Rp {{number_format($medicine->selling_price, 0, ',','.')}}</dd>
                <p class="text-xs dark:text-gray-200 text-gray-700">Price Diff : <span class="dark:text-emerald-500 text-emerald-700">Rp {{number_format($medicine->price_diff, 0, ',','.')}} </span></p>
              </div>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Purchase Price</dt>
              <div class="flex justify-between w-full sm:col-span-2 pr-2">
                <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:mt-0">Rp {{number_format($medicine->purchase_price, 0, ',','.')}}</dd>
                <p class="text-xs dark:text-gray-200 text-gray-700">Price Diff : <span class="dark:text-emerald-500 text-emerald-700">Rp {{number_format($medicine->price_diff, 0, ',','.')}} </span></p>
              </div>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Description</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->description }} </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Stock</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->stock }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Storage</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->storage }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Supplier Name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->supplier->name }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Category</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->category->name }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Unit</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->unit->name }}</dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Expiration Date</dt>
              <div class="flex justify-between w-full sm:col-span-2 pr-2">
                  <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $medicine->expired)->format('l, d F Y') }}</dd>
                  @if($medicine->is_expired)
                  <span class="dark:text-red-500 text-red-600 text-xs">Expired</span>
                  @else
                  <span class="dark:text-emerald-500 text-emerald-700 text-xs">Not Expired</span>
                  @endif
              </div>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Updated At</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->updated_at->format('d F Y') }}</dd>
              </div>
              <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Created At</dt>
                <div class="flex justify-between w-full sm:col-span-2 pr-2">
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $medicine->created_at->format('d F Y') }}</dd>
                    @if($medicine->created_at != $medicine->updated_at)
                    <span class="dark:text-indigo-600 text-indigo-700 text-xs">Has Been Updated</span>
                    @else
                    <span class="dark:text-indigo-600 text-indigo-700 text-xs">Never Been Updated</span>
                    @endif
                </div>
              </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Purchase History</dt>
              <dd class="mt-2 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                    @forelse ($medicine->purchases as $purchase)
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                      <div class="flex w-0 flex-1 items-center">
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                        </svg>
                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                          <span class="truncate font-medium">{{ $purchase->created_at->format('d M Y') }}</span>
                          <span> | </span>
                          <span class="flex-shrink-0 text-gray-400">Spent</span>
                          <span>Rp {{ number_format($purchase->pivot->purchase_price * $purchase->pivot->quantity, 0, ',','.') }}</span>
                          <span class="flex-shrink-0 text-gray-400"> for </span>
                          <span> {{ $purchase->pivot->quantity }} Item </span>
                        </div>
                      </div>
                      <div class="ml-4 flex-shrink-0">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Purchase Detail</a>
                      </div>
                    </li>
                    @empty
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                        No Purchase Data
                    </li>
                    @endforelse
                </ul>
              </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Sales History</dt>
              <dd class="mt-2 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                    @forelse ($medicine->sales as $sell)
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                      <div class="flex w-0 flex-1 items-center">
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                        </svg>
                        {{-- <div class="ml-4 flex min-w-0 flex-1 gap-2">
                          <span class="truncate font-medium">{{ $sell->created_at->format('d M Y') }}</span>
                          <span> | </span>
                          <span class="flex-shrink-0 text-gray-400">Spent</span>
                          <span>Rp {{ number_format($sell->pivot->sell_price * $sell->pivot->quantity, 0, ',','.') }}</span>
                          <span class="flex-shrink-0 text-gray-400"> for </span>
                          <span> {{ $sell->pivot->quantity }} Item </span>
                        </div> --}}
                      </div>
                      <div class="ml-4 flex-shrink-0">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">sell Detail</a>
                      </div>
                    </li>
                    @empty
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                        No Sales Data
                    </li>
                    @endforelse
                </ul>
              </dd>
            </div>

          </dl>
        </div>
    </section>

</div>
