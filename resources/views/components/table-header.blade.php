@props(['searchOnly' => false, 'ddFilter' => false])
@php
    switch ($searchOnly) {
    case true:
        $searchWrapperClass = 'w-full flex-nowrap';
        break;
    case false:
        $searchWrapperClass = 'w-full flex-nowrap';
        break;
    default:
        $searchWrapperClass = 'w-full flex-nowrap';
        break;
}
@endphp
<div {{ $attributes->merge(['class' => 'flex flex-wrap lg:flex-nowrap flex-col lg:flex-row items-center justify-between space-y-2 lg:space-y-0 lg:space-x-4 px-4 py-3']) }}>
    <div class="{{ $searchWrapperClass }}">
        @isset($search)
        {{ $search }}
        @endisset
    </div>
    @if(!$searchOnly)
    <div class="w-full lg:w-auto flex flex-nowrap {{ $ddFilter == false ? 'flex-col lg:flex-row space-y-2 lg:space-x-3' : 'flex-row space-x-3' }}  lg:space-y-0 justify-end  flex-shrink-0">
       @isset($main_button)
        {{ $main_button }}
            @if($ddFilter == true)
            @isset($actions)
                {{ $actions }}
            @endisset
            @endif
       @endisset
       @isset($actions)
        @if($ddFilter == false)
        <div class="flex items-start flex-nowrap justify-start md:justify-center space-x-3 w-full lg:w-auto overflow-x-auto no-scrollbar px-0">
            {{ $actions }}
        </div>
        @endif
       @endisset
    </div>
    @endif
</div>
