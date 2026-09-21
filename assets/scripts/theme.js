const themeStorageKey = 'site-theme';
const darkTheme = 'dark';
const lightTheme = 'light';

const updateThemeLogos = (isDark) => {
    document.querySelectorAll('[data-theme-logo]').forEach((logo) => {
        logo.src = isDark ? '/build/images/logo_nav_dark.png' : '/build/images/logo_nav.png';
    });
};

const updateThemeButton = (isDark) => {
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const icon = button.querySelector('i');
        button.setAttribute('aria-label', isDark ? 'Activer le mode clair' : 'Activer le mode sombre');
        button.setAttribute('title', isDark ? 'Mode clair' : 'Mode sombre');

        if (icon) {
            icon.classList.toggle('fa-moon', !isDark);
            icon.classList.toggle('fa-sun', isDark);
        }
    });
    updateThemeLogos(isDark);
};

const setTheme = (theme) => {
    const isDark = theme === darkTheme;
    document.body.classList.toggle('dark-mode', isDark);
    updateThemeButton(isDark);
};

document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem(themeStorageKey);
    setTheme(savedTheme === darkTheme ? darkTheme : lightTheme);

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const isDark = document.body.classList.toggle('dark-mode');
            const theme = isDark ? darkTheme : lightTheme;
            localStorage.setItem(themeStorageKey, theme);
            updateThemeButton(isDark);
        });
    });
});
