<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-42 h-12 px-4 py-2 bg-green-500 border border-transparent rounded-md text-sm font-roboto text-white']) }}>
    <span class="mr-8">{{ $slot }}</span>
    <div class="h-12 w-1 bg-green-600"></div>
    <svg class='w-7 ml-4'cache-id="6aa466e93f524ade877d8c51e82d74fa" id="e02Ut3SO98j1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><g><path d="M6,12l4.2426,4.2426L18.727,7.75732" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>

</button>
