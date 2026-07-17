import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Source Serif 4', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    bg: '#f0f0d8',
                    surface: '#e8e8ca',
                    ink: '#1c1c14',
                    muted: '#555545',
                    primary: '#7d8a5a',
                    'primary-light': '#e3e8d0',
                    accent: '#8a5a47',
                    'accent-light': '#efe0d8',
                },
            },
            maxWidth: {
                measure: '70ch',
            },
            zIndex: {
                dropdown: '100',
                sticky: '200',
                backdrop: '300',
                modal: '400',
                toast: '500',
                tooltip: '600',
            },
        },
    },

    plugins: [forms],
};
