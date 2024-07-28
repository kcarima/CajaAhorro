<template id="validation-error-template">
    <div {{ $attributes->merge(['class' => 'validation-error mb-4']) }}>
         <h2 class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Algo salió mal.') }}</h2>
         <ul class="mt-3 text-sm text-red-600 dark:text-red-400">
            <li class="flex items-center gap-1 list-error">
                <svg class="fill-red-600 dark:fill-red-400" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </li>
         </ul>
     </div>
</template>
