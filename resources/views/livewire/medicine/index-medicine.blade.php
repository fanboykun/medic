
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
