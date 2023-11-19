<nav class="flex items-start w-full p-4" aria-label="Table navigation">
    <div class="flex justify-between min-w-full">
        <div>
            @isset($nav_info)
            {{ $nav_info }}
            @endisset
        </div>
        <div>
            @isset($nav_link)
            {{ $nav_link }}
            @endisset
        </div>
    </div>
</nav>
