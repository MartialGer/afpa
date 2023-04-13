const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                Kanit: ['Kanit', 'sans-serif'],
                roboto: ['Roboto', 'sans-serif'],
            },
            colors: {
                'vert-clair': '#87BB34',
                'vert-fonce': '#44A33D',
                'rose-afpa': '#E3007E',
              },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
