import { computed } from 'vue';

const translations = {
  en: {
    products: 'Products',
    categories: 'Categories',
    all_products: 'All Products',
    no_image: 'No Image',
    view_details: 'View Details',
    add_to_cart: 'Add to Cart',
    back_to_products: 'Back to Products',
    home: 'Home',
    about: 'About',
    contact: 'Contact',
    cart: 'Cart',
    checkout: 'Checkout',
    account: 'Account',
    logout: 'Logout',
    login: 'Login',
    register: 'Register',
    dark_mode: 'Dark Mode',
    language: 'Language',
  },
  ar: {
    products: 'المنتجات',
    categories: 'الفئات',
    all_products: 'جميع المنتجات',
    no_image: 'لا توجد صورة',
    view_details: 'عرض التفاصيل',
    add_to_cart: 'أضف إلى السلة',
    back_to_products: 'العودة إلى المنتجات',
    home: 'الرئيسية',
    about: 'حول',
    contact: 'اتصل',
    cart: 'السلة',
    checkout: 'الدفع',
    account: 'الحساب',
    logout: 'تسجيل الخروج',
    login: 'تسجيل الدخول',
    register: 'إنشاء حساب',
    dark_mode: 'الوضع الليلي',
    language: 'اللغة',
  },
};

export function useI18n() {
  const language = computed(() => localStorage.getItem('language') || 'en');

  const t = (key) => {
    return translations[language.value]?.[key] || key;
  };

  const setLanguage = (lang) => {
    localStorage.setItem('language', lang);
    document.documentElement.lang = lang;
    document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
  };

  return {
    language,
    t,
    setLanguage,
  };
}
