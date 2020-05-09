const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        exo: ['"Exo 2"', 'Verdana', 'serif']
      },
      colors: {
        gray: {
          ...colors.gray,
          50: '#00000008',
          150: '#f8fafc',
        },
        't-white': {
          50: 'rgba(255, 255, 255, 0.5)',
          70: 'rgba(255, 255, 255, 0.7)',
          80: 'rgba(255, 255, 255, 0.8)',
          90: 'rgba(255, 255, 255, 0.9)',
        }
      },
      boxShadow: {
        invalid: '0 0 0 0.2rem rgba(220,53,69,.25)'
      }
    }
  }
}
