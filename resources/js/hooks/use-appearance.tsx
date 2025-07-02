import { useCallback, useEffect, useState } from 'react';

export type Appearance = 'light' | 'dark' | 'system';

const prefersDark = () => {
    if (typeof window === 'undefined') {
        return false;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches;
};

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const applyTheme = (appearance: Appearance) => {
    const isDark = appearance === 'dark' || (appearance === 'system' && prefersDark());

    document.documentElement.classList.toggle('dark', isDark);
};

const mediaQuery = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    return window.matchMedia('(prefers-color-scheme: dark)');
};

const handleSystemThemeChange = () => {
    const currentAppearance = localStorage.getItem('appearance') as Appearance;
    applyTheme(currentAppearance || 'system');
};

export function initializeTheme() {
    const savedAppearance = (localStorage.getItem('appearance') as Appearance) || 'system';

    applyTheme(savedAppearance);

    // Add the event listener for system theme changes...
    mediaQuery()?.addEventListener('change', handleSystemThemeChange);
}

export function useAppearance() {
  const isClient = typeof window !== 'undefined' && typeof document !== 'undefined';

  const [appearance, setAppearance] = useState<Appearance>('system');

  const updateAppearance = useCallback((mode: Appearance) => {
  setAppearance(mode);

  if (typeof window !== 'undefined' && typeof document !== 'undefined') {
    localStorage.setItem('appearance', mode);
    document.cookie = `appearance=${mode}; path=/; max-age=${365 * 24 * 60 * 60}`;

    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDark = mode === 'dark' || (mode === 'system' && prefersDark);
    document.documentElement.classList.toggle('dark', isDark);
  }
}, []);


  useEffect(() => {
    if (typeof window === 'undefined' || typeof document === 'undefined') return;

    const saved = (localStorage.getItem('appearance') as Appearance) || 'system';
    updateAppearance(saved);

    const media = window.matchMedia('(prefers-color-scheme: dark)');
    const handler = () => updateAppearance(saved);
    media.addEventListener('change', handler);

    return () => media.removeEventListener('change', handler);
    }, [updateAppearance]);


  return { appearance, updateAppearance } as const;
}
