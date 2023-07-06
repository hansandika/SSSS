/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/@iconscout/unicons/css/line.css",
    ],
    darkMode: false,
    theme: {
        extend: {
            colors: {
                black: {
                    50: "#F7F7F8",
                    100: "#DDDDDF",
                    200: "#A9A9AD",
                    300: "#8E8E93",
                    400: "#636366",
                    500: "#48484A",
                    600: "#3A3A3C",
                    700: "#2C2C2E",
                    800: "#1A1C1E",
                },
                earth: "#40513B",
                nature: "#609966",
                leaf: "#9DC08B",
                sage: "#EDF1D6",
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
