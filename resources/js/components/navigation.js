import { queryAll } from '../core/dom';

export function initNavigation(root = document) {
    queryAll('[data-nav]', root).forEach((nav) => {
        const toggle = nav.querySelector('[data-nav-toggle]');
        const menu = nav.querySelector('[data-nav-menu]');

        if (!toggle || !menu || nav.dataset.navReady === 'true') {
            return;
        }

        nav.dataset.navReady = 'true';
        toggle.setAttribute('aria-expanded', 'false');

        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('is-open');

            toggle.setAttribute('aria-expanded', String(isOpen));
            menu.hidden = !isOpen;
        });

        const mediaQuery = window.matchMedia('(max-width: 760px)');
        const syncMenu = () => {
            const isMobile = mediaQuery.matches;
            const isOpen = nav.classList.contains('is-open');

            menu.hidden = isMobile && !isOpen;
        };

        mediaQuery.addEventListener('change', () => {
            nav.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            syncMenu();
        });

        nav.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                syncMenu();
                toggle.focus();
            }
        });

        syncMenu();
    });
}
