@props(['icon'])
<button type="button" x-on:click="showChild = 1" class="flex items-center justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
    @if(isset($icon))
    {{ $icon }}
    @else
    <x-icons.caret />
    @endif
    <span>
        {{ $slot }}
    </span>
</button>

