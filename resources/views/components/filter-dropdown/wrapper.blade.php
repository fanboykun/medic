@props(['numberOfMainItem' => 1])
<div {!! $attributes !!}
    x-data="{
        dd : false,
        filtered : false,
        openDd() {
            this.dd = true
        }
    }">
    {{ $trigger }}
    <div x-data="{ showChild : 0 }" x-on:mouseleave="showChild = 0">
        <!-- Dropdown menu -->
        <div x-cloak x-show="dd == true" x-on:click.outside="dd = false" class="z-10 absolute flex flex-row mt-2  bg-white divide-y divide-gray-100 rounded-lg shadow min-w-[150px] dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full">
                @isset($reset_button)
                <li x-show="filtered == true" class="w-full">
                    {{ $reset_button }}
                </li>
                @endisset
                <li x-on:mouseover="showChild = 1" class="w-full relative group">
                    <button type="button" x-on:click="showChild = 1" class="flex items-center justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <x-icons.caret />
                        <span>Main</span>
                    </button>
                    <div x-cloak x-show="showChild == 1" class="absolute flex flex-row z-[9999] min-w-[200px] max-h-[150px] sm:max-h-[300px] overflow-y-auto bg-white dark:bg-gray-700 top-0 rounded-lg shadow-md border-2 border-indigo-500" style="transform: translateX(calc(-100%))">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center w-full" aria-labelledby="dropdownHoverButton">
                            <li class="w-full">
                                <button type="button" class="flex items-center justify-between w-full h-fit px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Child
                                    <x-icons.check />
                                </button>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
