<select {{ $attributes->merge(['class' => 'py-2 px-2 w-fit text-sm dark:bg-gray-700 dark:text-white rounded-full']) }}>
    {{ $slot }}
</select>
