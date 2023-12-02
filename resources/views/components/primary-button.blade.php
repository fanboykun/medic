<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
