<div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg overflow-hidden">
    @isset($table_header)
    {{ $table_header }}
    @endisset
    <div class="mih-h-[40vh] max-h-[70vh] overflow-scroll no-scrollbar">
        <table class="relative w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                {{ $th }}
            </thead>
            <tbody>
                {{ $tbody }}
            </tbody>
        </table>
    </div>
    @isset($table_navigation)
    {{ $table_navigation }}
    @endisset
</div>
