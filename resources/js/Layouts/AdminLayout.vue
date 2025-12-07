<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 dark:bg-gray-950 text-white shadow-lg">
      <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
      </div>
      <nav class="mt-6 space-y-2">
        <Link
          :href="route('admin.dashboard')"
          :class="isActive('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700'"
          class="block px-4 py-3 rounded transition"
        >
          Dashboard
        </Link>
        <Link
          :href="route('admin.products.index')"
          :class="isActive('admin.products') ? 'bg-blue-600' : 'hover:bg-gray-700'"
          class="block px-4 py-3 rounded transition"
        >
          Products
        </Link>
        <Link
          :href="route('admin.categories.index')"
          :class="isActive('admin.categories') ? 'bg-blue-600' : 'hover:bg-gray-700'"
          class="block px-4 py-3 rounded transition"
        >
          Categories
        </Link>
        <Link
          :href="route('admin.orders.index')"
          :class="isActive('admin.orders') ? 'bg-blue-600' : 'hover:bg-gray-700'"
          class="block px-4 py-3 rounded transition"
        >
          Orders
        </Link>
        <Link
          :href="route('admin.users.index')"
          :class="isActive('admin.users') ? 'bg-blue-600' : 'hover:bg-gray-700'"
          class="block px-4 py-3 rounded transition"
        >
          Users
        </Link>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Bar -->
      <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
          <slot name="header">Dashboard</slot>
        </h2>
        <div class="flex items-center space-x-4">
          <!-- Language Toggle -->
          <button
            @click="toggleLanguage"
            class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg text-sm font-medium"
          >
            {{ isArabic ? 'EN' : 'AR' }}
          </button>
          <!-- Dark Mode Toggle -->
          <button
            @click="toggleDarkMode"
            class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg text-sm font-medium"
          >
            {{ isDarkMode ? '☀️' : '🌙' }}
          </button>
          <!-- User Menu -->
          <div class="relative">
            <button @click="showUserMenu = !showUserMenu" class="flex items-center space-x-2">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ user.name }}</span>
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
            <div v-if="showUserMenu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg z-50">
              <Link href="/profile" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                Profile
              </Link>
              <form @submit.prevent="logout" class="border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Page Content -->
      <div class="flex-1 overflow-auto bg-gray-50 dark:bg-gray-900 p-6">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
const showUserMenu = ref(false);
const isArabic = computed(() => localStorage.getItem('language') === 'ar');
const isDarkMode = computed(() => document.documentElement.classList.contains('dark'));

const isActive = (routeName) => {
  return page.url.includes(routeName.split('.')[1]);
};

const toggleLanguage = () => {
  const newLang = isArabic.value ? 'en' : 'ar';
  localStorage.setItem('language', newLang);
  window.location.reload();
};

const toggleDarkMode = () => {
  document.documentElement.classList.toggle('dark');
  localStorage.setItem('darkMode', isDarkMode.value ? 'false' : 'true');
};

const logout = () => {
  router.post(route('logout'));
};
</script>
