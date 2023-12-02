@props(['method' => '', 'action' => ''])
<div {{ $attributes->merge(['class' => 'bg-gray-50 dark:bg-gray-900 shadow-md rounded-lg w-full sm:py-2 sm:px-4 h-fit']) }}>
    @isset($form_header)
    <div class="flex bg-gray-400 text-gray-50 dark:bg-gray-700 dark:text-gray-400 py-2 rounded-xl item-center justify-center">
        {{ $form_header }}
    </div>
    @endisset
    <form wire:submit="{{ $action }}" class="p-4" {{ $method != '' ? $method : '' }}>
        {{ $form_body }}
        @isset($form_action)
        <div class="flex">
            {{ $form_action }}
        </div>
        @endisset
    </form>
</div>
