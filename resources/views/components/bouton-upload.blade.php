<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-42 h-12 px-4 py-2 bg-blue-500 border border-transparent rounded-md text-sm font-roboto text-white']) }}>
    <span class="mr-9">{{ $slot }}</span>
    <div class="h-12 w-1 bg-blue-600"></div>
    <svg class='w-6 ml-4' id="enVqU3irL9h1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><g><path d="M12,18v-6m0,0L9,14m3-2l3,2M13,3.00087C12.9045,3,12.7973,3,12.6747,3h-4.4745c-1.12011,0-1.68058,0-2.1084.21799-.37633.19174-.68207.49748-.87381.87381C5,4.51962,5,5.08009,5,6.2002v11.6c0,1.1201,0,1.6799.21799,2.1077.19174.3763.49748.6826.87381.8743C6.51921,21,7.079,21,8.19694,21h7.60616c1.1179,0,1.6769,0,2.1043-.2178.3763-.1917.6831-.498.8748-.8743C19,19.4805,19,18.9215,19,17.8036v-8.47792c0-.12272,0-.23007-.0009-.32568M13,3.00087c.2856.0026.4663.01298.6388.05439.2041.04899.3991.13.578.23966.2018.12365.375.2969.7207.64258L18.063,7.06298c.3459.34591.5179.51838.6416.72021.1096.17895.1907.37407.2397.57814.0414.17243.052.35318.0548.63867M13,3.00087L13,5.8c0,1.1201,0,1.67977.218,2.10759.1917.37633.4975.68289.8738.87464C14.5192,9,15.079,9,16.1969,9h2.8022m0,0h.0011" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>

</button>

