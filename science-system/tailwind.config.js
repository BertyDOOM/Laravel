import forms from '@tailwindcss/forms'

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                bookish: "#8b3a2f", // кафяво-червен
        },
    },
    plugins: [forms],
}}
