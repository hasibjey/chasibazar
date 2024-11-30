import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            xs: { max: "575px" },
            sm: "576px",
            md: "768px",
            "md-max": { max: "768px" },
            lg: "992px",
            xl: "1200px",
            "2xl": "1400px",
        },
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    sm: "2rem",
                    md: "2rem",
                    lg: "3rem",
                    xl: "0",
                },
                screens: {
                    sm: "100%",
                    md: "768px",
                    lg: "1024px",
                    xl: "1400px",
                },
            },
            colors: {
                primary: "#027351",
                "primary-1": "#10B981",
                secondary: "#031C06",
            },
            fontFamily: {
                Poppins: ["Poppins", "sans-serif"],
            },
            fontSize: {
                11: [
                    "11px",
                    {
                        lineHeight: "11px",
                    },
                ],
                13: [
                    "13px",
                    {
                        lineHeight: "15px",
                    },
                ],
                15: [
                    "15px",
                    {
                        lineHeight: "15px",
                    },
                ],
            },
            animation: {
                zoom: "zoom .200s linear 1",
            },
            keyframes: {
                zoom: {
                    "0% 100%": { scale: "1" },
                    "50%": { scale: "1.2" },
                },
            },
        },
    },
    plugins: [],
};
