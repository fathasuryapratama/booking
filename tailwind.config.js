// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",  // kalau pakai Vue
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          DEFAULT: "#4f46e5", // ungu utama
          light: "#818cf8",   // ungu muda
          dark: "#3730a3",    // ungu tua
        },
        success: "#16a34a",   // hijau untuk sukses
        danger: "#dc2626",    // merah untuk error
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui"], // font kustom
      },
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
  ],
};
