<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="pb-4 pt-4 pl-4 bg-white flex item-center dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <button type="button" class="absolute right-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-small rounded-lg  text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
              </svg>
            <span>Add Medicine</span>
          </button>
        <div class="relative mt-1">

            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">No.</th>
                <th scope="col" class="px-6 py-3"> Name</th>
                {{-- <th scope="col" class="px-6 py-3"> Storage</th> --}}
                <th scope="col" class="px-6 py-3"> Stock</th>
                <th scope="col" class="px-6 py-3"> Unit</th>
                <th scope="col" class="px-6 py-3"> Category</th>
                <th scope="col" class="px-6 py-3"> Expired</th>
                {{-- <th scope="col" class="px-6 py-3"> Description</th> --}}
                <th scope="col" class="px-6 py-3"> Purchase Price</th>
                <th scope="col" class="px-6 py-3"> Selling Price</th>
                <th scope="col" class="px-6 py-3"> Supplier</th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
        @forelse ($medicines as $medicine)

        {{-- @endforeach ($medicines as $medicine) --}}
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

            @if (session()->has('message'))
                <div class="alert alert-success">
                   {{ session('message') }}
                </div>
            @endif
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $medicine->id }}
                </th>
                <td class="px-6 py-4">{{ $medicine->name }}</td>
                {{-- <td class="px-6 py-4">{{ $medicine->storage }}</td> --}}
                <td class="px-6 py-4">{{ $medicine->stock }}</td>
                <td class="px-6 py-4">{{ $medicine->unit->name}}</td>
                <td class="px-6 py-4">{{ $medicine->category->name}}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $medicine->expired)->format('d M Y') }}</td>
                {{-- <td class="px-6 py-4">{{ $medicine->description }}</td> --}}
                <td class="px-6 py-4">Rp {{number_format($medicine->purchase_price, 0, ',','.')}}</td>
                <td class="px-6 py-4">Rp {{number_format($medicine->selling_price, 0, ',','.')}}</td>
                <td class="px-6 py-4">{{ $medicine->supplier->name}}</td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
