import { onMounted, ref } from 'vue';

type Appearance = 'light' | 'dark' | 'grey' | 'system';

const isClient = () => typeof window !== 'undefined';

export function updateTheme(value: Appearance) {
    console.log('Updating theme to:', value);

    if (typeof window === 'undefined') {
        return;
    }

    if (value === 'system') {
        const mediaQueryList = window.matchMedia(
            '(prefers-color-scheme: dark)',
        );
        const systemTheme = mediaQueryList.matches ? 'dark' : 'light';

        document.documentElement.classList.toggle(
            'dark',
            systemTheme === 'dark',
        );
        document.documentElement.classList.remove('light', 'grey');
    } else if (value === 'light') {
        document.documentElement.classList.toggle('light', value === 'light');
        document.documentElement.classList.remove('dark', 'grey');
    } else if (value === 'dark') {
        document.documentElement.classList.toggle('dark', value === 'dark');
        document.documentElement.classList.remove('light', 'grey');
    } else {
        document.documentElement.classList.remove('light', 'dark');
        document.documentElement.classList.toggle('grey', value === 'grey');
    }
}

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }
    console.log('Setting cookie:', name, value);
    const maxAge = days * 24 * 60 * 60;

    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const mediaQuery = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    return window.matchMedia('(prefers-color-scheme: dark)');
};

const getStoredAppearance = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    return localStorage.getItem('appearance') as Appearance | null;
};

const handleSystemThemeChange = () => {
    const currentAppearance = getStoredAppearance();

    updateTheme(currentAppearance || 'system');
};

export function initializeTheme() {
    if (typeof window === 'undefined') {
        return;
    }

    // Initialize theme from saved preference or default to system...
    const savedAppearance = getStoredAppearance();
    updateTheme(savedAppearance || 'system');

    // Set up system theme change listener...
    mediaQuery()?.addEventListener('change', handleSystemThemeChange);
}

const appearance = ref<Appearance>('system');

let systemThemeListenerAdded = false;

export function useAppearance() {
    onMounted(() => {
        console.log('useAppearance mounted');

        const savedAppearance = localStorage.getItem(
            'appearance'
        ) as Appearance | null;

        if (savedAppearance) {
            appearance.value = savedAppearance;
        }
    });


    function updateAppearance(value: Appearance) {
        appearance.value = value;

        // Store in localStorage for client-side persistence...
        localStorage.setItem('appearance', value);

        // Store in cookie for SSR...
        setCookie('appearance', value);

        updateTheme(value);
    }

    return {
        appearance,
        updateAppearance,
    };
}
