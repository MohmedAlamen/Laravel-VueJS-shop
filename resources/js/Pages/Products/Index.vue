<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $t('products') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Categories Filter -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
            {{ $t('categories') }}
          </h3>
          <div class="flex flex-wrap gap-2">
            <Link
              href="/"
              class="px-4 py-2 rounded-lg"
              :class="!currentCategory ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100'"
            >
              {{ $t('all_products') }}
            </Link>
            <Link
              v-for="category in categories"
              :key="category.id"
              :href="`/category/${category.slug}`"
              class="px-4 py-2 rounded-lg"
              :class="currentCategory?.id === category.id ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100'"
            >
              {{ isArabic ? category.name_ar : category.name_en }}
            </Link>
          </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div
            v-for="product in products.data"
            :key="product.id"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition overflow-hidden"
          >
            <div class="aspect-square bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
              <img
                v-if="product.image"
                :src="`/images/${product.image}`"
                :alt="isArabic ? product.name_ar : product.name_en"
                class="w-full h-full object-cover"
              />
              <span v-else class="text-gray-400 dark:text-gray-500">{{ $t('no_image') }}</span>
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">
                {{ isArabic ? product.name_ar : product.name_en }}
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                {{ isArabic ? product.description_ar : product.description_en }}
              </p>
              <div class="flex items-center justify-between">
                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                  ${{ product.price }}
                </span>
                <Link
                  :href="`/product/${product.slug}`"
                  class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                  {{ $t('view_details') }}
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="products.links" class="mt-8 flex justify-center gap-2">
          <Link
            v-for="link in products.links"
            :key="link.label"
            :href="link.url || '#'"
            :class="[
              'px-3 py-2 rounded-lg',
              link.active
                ? 'bg-blue-600 text-white'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600'
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  products: Object,
  categories: Array,
  currentCategory: Object,
});

const isArabic = computed(() => localStorage.getItem('language') === 'ar');
</script>
