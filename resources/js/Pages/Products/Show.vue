<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ isArabic ? product.name_ar : product.name_en }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <!-- Product Image -->
            <div class="flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg">
              <img
                v-if="product.image"
                :src="`/images/${product.image}`"
                :alt="isArabic ? product.name_ar : product.name_en"
                class="w-full h-auto object-cover"
              />
              <span v-else class="text-gray-400 dark:text-gray-500">{{ $t('no_image') }}</span>
            </div>

            <!-- Product Details -->
            <div>
              <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ isArabic ? product.name_ar : product.name_en }}
              </h1>
              
              <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ isArabic ? product.category.name_ar : product.category.name_en }}
              </p>

              <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-6">
                ${{ product.price }}
              </p>

              <p class="text-gray-700 dark:text-gray-300 mb-8 leading-relaxed">
                {{ isArabic ? product.description_ar : product.description_en }}
              </p>

              <div class="flex gap-4 mb-8">
                <input
                  v-model.number="quantity"
                  type="number"
                  min="1"
                  class="w-20 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                />
                <button
                  @click="addToCart"
                  class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold"
                >
                  {{ $t('add_to_cart') }}
                </button>
              </div>

              <Link
                href="/"
                class="text-blue-600 dark:text-blue-400 hover:underline"
              >
                ← {{ $t('back_to_products') }}
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  product: Object,
});

const quantity = ref(1);
const isArabic = computed(() => localStorage.getItem('language') === 'ar');

const addToCart = () => {
  // Cart functionality will be implemented later
  alert('Product added to cart!');
};
</script>
