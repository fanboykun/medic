<div>
    <div class="bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg w-full sm:py-2 sm:px-4 h-fit">
        <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-2 rounded-xl item-center justify-center">
            Add Category Form
        </div>
        <form class="p-4" wire:submit="saveCategory" x-on:close-modal.window="show = false">
            <div class="relative z-0 w-full mb-6 group p-2">
                <input type="text" name="name" wire:model="categoryForm.name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Name of The Category <span class="text-xs font-light text-red-500">*</span>
                </label>
                @error('categoryForm.name')
                <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group p-2">
                <input type="text" name="description" wire:model="categoryForm.description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description Category</label>
                @error('categoryForm.escription')
                <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
            <div class="flex">
                <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                    Clear
                </x-secondary-button>
                <button type="submit" wire:submit.attr="disabled" wire:target="saveCategory" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </form>
    </div>
</div>
