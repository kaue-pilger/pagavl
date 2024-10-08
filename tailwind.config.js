import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors: {
            'daintree': '#022128',
            'te-papa-green': '#1B4643',
            'algae-gree': '#7CDDAE',
            'oslo-gray': '#7B8B8F',
            'black-haze': '#F7F8F8',
            'white': '#FFFFFF',
            'iron': '#E3E4E4'
        },
        extend: {
            fontFamily: {
                sans: ['Ginka', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
