<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-42 h-12 px-4 py-2 bg-red-500 border border-transparent rounded-md text-sm font-roboto text-white']) }}>
    <span class="mr-8">{{ $slot }}</span>
    <div class="h-12 w-1 bg-red-600"></div>
    <svg class='w-6 ml-4' id="eVpRuDPk7gf1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><g><path d="M18,18l-6-6m0,0L6,6m6,6l6-6m-6,6L6,18" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>

</button>
