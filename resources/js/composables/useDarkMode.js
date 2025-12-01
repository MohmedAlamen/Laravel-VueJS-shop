import { computed } from 'vue';

export function useDarkMode() {
  const isDarkMode = computed(() => localStorage.getItem('darkMode') === 'true');

  const toggleDarkMode = () => {
    const newValue = !isDarkMode.value;
    localStorage.setItem('darkMode', newValue);
    
    if (newValue) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  };

  const initializeDarkMode = () => {
    const savedMode = localStorage.getItem('darkMode');
    if (savedMode === 'true') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  };

  return {
    isDarkMode,
    toggleDarkMode,
    initializeDarkMode,
  };
}
