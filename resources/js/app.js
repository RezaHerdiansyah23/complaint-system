import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Global dark mode store
Alpine.store('theme', {
    dark: false,
    init() {
        const saved = localStorage.getItem('theme');
        this.dark = saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches);
        this.apply();
    },
    toggle() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        this.apply();
    },
    apply() {
        document.documentElement.classList.toggle('dark', this.dark);
    }
});

// Global sidebar store
Alpine.store('sidebar', {
    open: true,
    init() {
        const saved = localStorage.getItem('sidebar');
        this.open = saved === null ? true : saved === 'open';
    },
    toggle() {
        this.open = !this.open;
        localStorage.setItem('sidebar', this.open ? 'open' : 'closed');
    }
});

Alpine.start();
