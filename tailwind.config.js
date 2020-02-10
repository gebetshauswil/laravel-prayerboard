module.exports = {
    theme: {
        extend: {
            fontFamily: {
                'nunito': ['Nunito', 'sans-serif'],
            },
            fontSize: {
                '7xl': '5rem',
            }
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms'),
    ],
};
