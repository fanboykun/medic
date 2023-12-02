@props(['smbtn' => false])
@php
    switch ($smbtn) {
        case true :
            $searchWrapperClass = 'flex justify-between w-full ';
            $searchInputWrapperClass = 'relative w-full py-3 mb-1 px-2';
            break;
            case false :
            $searchWrapperClass = 'flex items-center';
            $searchInputWrapperClass = 'relative w-full py-3 mb-1 px-2';
            break;
            default :
            $searchWrapperClass = 'flex items-center';
            $searchInputWrapperClass = 'relative w-full py-3 mb-1 px-2';
            break;
    }
@endphp
<div class="{{ $searchWrapperClass }}">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="{{ $searchInputWrapperClass }}">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
           <x-icons.search />
        </div>
            {{ $input }}
        </div>
        @isset($btn)
        <div class="flex lg:hidden items-center justify-end py-3 px-2 whitespace-nowrap ">
            {{ $btn }}
        </div>
        @endisset
</div>
