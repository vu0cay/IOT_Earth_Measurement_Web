import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // content: [
    //     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //     './storage/framework/views/*.php',
    //     './resources/views/**/*.blade.php',
    // ],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primaryBlue':'#00afef',
                'scndBlue':'#1f5ca9',
                'vGray':'#F0F0F0',
                'thirdBlue':'#1B4F91',
                'darken':'rgb(1,0,26,0.2)',
                'darken2':'rgb(0,0,0,0.2)'
            }
        },
    },

    plugins: [forms],
};
