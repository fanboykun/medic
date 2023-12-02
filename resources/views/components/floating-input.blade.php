@props(['label_name' => '', 'name', 'id', 'model', 'requiredSymbol' => false, 'type', 'required' => false, 'showError' => false])
@php
    if($required != false) {
        $isRequired = 'required';
    }else {
        $isRequired = '';
    }
@endphp

<div {{ $attributes->merge(['class' => 'relative z-0 w-full mb-6 group p-2']) }}>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" wire:model="{{ $model }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" {{ $isRequired }} placeholder=" ">

    <label for="{{ $name }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
        {{ $label_name }}
        @if($requiredSymbol != false)
            <span class="text-xs font-light text-red-500">*</span>
        @endif
    </label>
    @if($showError != false)
        @error($model)
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    @endif
</div>

