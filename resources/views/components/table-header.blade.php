<div class="flex flex-wrap lg:flex-nowrap overflow-x-auto no-scrollbar flex-col lg:flex-row items-center justify-between space-y-2 lg:space-y-0 lg:space-x-4 p-4">
    <div class="w-full lg:w-1/2 flex-nowrap">
        @isset($search)
        {{ $search }}
        @endisset
    </div>
    <div class="w-full lg:w-auto flex flex-col lg:flex-row space-y-2 lg:space-y-0 items-stretch justify-end lg:space-x-3 flex-shrink-0">
       @isset($main_button)
        {{ $main_button }}
       @endisset
       @isset($actions)
       <div class="flex items-center justify-center space-x-3 w-full lg:w-auto">
           {{ $actions }}
        </div>
       @endisset
    </div>
</div>
