import { useCallback, useEffect, useState } from 'react';

export type Appearance = 'light' | 'dark' | 'system';

const isClient = typeof window !== 'undefined' && typeof document !== 'undefined';

const prefersDark = () =>
  isClient && window.matchMedia('(prefers-color-scheme: dark)').matches;

const applyTheme = (appearance: Appearance) => {
  const isDark = appearance === 'dark' || (appearance === 'system' && prefersDark());
  document.documentElement.classList.toggle('dark', isDark);
};

const getMediaQuery = () =>
  isClient ? window.matchMedia('(prefers-color-scheme: dark)') : null;

const handleSystemThemeChange = () => {
  const saved = (localStorage.getItem('appearance') as Appearance) || 'system';
  applyTheme(saved);
};

export function initializeTheme() {
  if (!isClient) return;

  const savedAppearance = (localStorage.getItem('appearance') as Appearance) || 'system';
  applyTheme(savedAppearance);
  getMediaQuery()?.addEventListener('change', handleSystemThemeChange);
}

export function useAppearance() {
  const [appearance, setAppearance] = useState<Appearance>('system');

  const updateAppearance = useCallback((mode: Appearance) => {
    setAppearance(mode);

    if (!isClient) return;

    localStorage.setItem('appearance', mode);
    document.cookie = `appearance=${mode}; path=/; max-age=${365 * 24 * 60 * 60}`;

    const isDark =
      mode === 'dark' ||
      (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

    document.documentElement.classList.toggle('dark', isDark);
  }, []);

  useEffect(() => {
    if (!isClient) return;

    const saved = (localStorage.getItem('appearance') as Appearance) || 'system';
    updateAppearance(saved);

    const media = window.matchMedia('(prefers-color-scheme: dark)');
    const handler = () => updateAppearance(saved);
    media.addEventListener('change', handler);

    return () => media.removeEventListener('change', handler);
  }, [updateAppearance]);

  return { appearance, updateAppearance } as const;
}
