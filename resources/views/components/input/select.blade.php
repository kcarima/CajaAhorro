<select {{ $attributes->merge(["class" => "border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-gray-200"]) }} {{ $attributes }}>
    {{ $slot }}
</select>
