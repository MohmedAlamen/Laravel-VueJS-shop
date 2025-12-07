<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $t('cart') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="cartItems.length === 0" class="text-center py-10 bg-white dark:bg-gray-800 rounded-lg shadow">
          <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">{{ $t('cart_empty') }}</p>
          <Link :href="route('products.index')" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            {{ $t('continue_shopping') }}
          </Link>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Cart Items List -->
          <div class="lg:col-span-2 space-y-4">
            <div v-for="item in cartItems" :key="item.id" class="flex items-center bg-white dark:bg-gray-800 rounded-lg shadow p-4">
              <img
                v-if="item.product.image"
                :src="`/images/${item.product.image}`"
                :alt="isArabic ? item.product.name_ar : item.product.name_en"
                class="w-20 h-20 object-cover rounded-md"
              />
              <div class="flex-1 mx-4">
                <Link :href="route('products.show', item.product.slug)" class="font-semibold text-gray-900 dark:text-gray-100 hover:text-blue-600">
                  {{ isArabic ? item.product.name_ar : item.product.name_en }}
                </Link>
                <p class="text-sm text-gray-500 dark:text-gray-400">${{ item.product.price }}</p>
              </div>

              <!-- Quantity and Remove -->
              <input
                :value="item.quantity"
                @change="updateQuantity(item.product_id, $event.target.value)"
                type="number"
                min="1"
                class="w-16 text-center border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-100 px-2 py-1"
              />
              <button
                @click="removeItem(item.product_id)"
                class="ml-4 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
              >
                {{ $t('remove') }}
              </button>
            </div>
          </div>

          <!-- Order Summary -->
          <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow p-6 h-fit">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $t('order_summary') }}</h3>
            <div class="space-y-2 border-b pb-4 mb-4 text-gray-700 dark:text-gray-300">
              <div class="flex justify-between">
                <span>{{ $t('subtotal') }}</span>
                <span>${{ cartTotal.toFixed(2) }}</span>
              </div>
              <div class="flex justify-between">
                <span>{{ $t('shipping') }}</span>
                <span>{{ $t('free') }}</span>
              </div>
            </div>
            <div class="flex justify-between font-bold text-xl text-gray-900 dark:text-gray-100 mb-6">
              <span>{{ $t('total') }}</span>
              <span>${{ cartTotal.toFixed(2) }}</span>
            </div>
            <Link
              :href="route('checkout.index')"
              class="w-full block text-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold"
            >
              {{ $t('proceed_to_checkout') }}
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  cartItems: Array,
  cartTotal: Number,
});

const isArabic = computed(() => localStorage.getItem('language') === 'ar');

const removeItem = (productId) => {
  router.delete(route('cart.destroy'), {
    data: { product_id: productId },
  });
};

const updateQuantity = (productId, quantity) => {
  router.put(route('cart.update'), {
    product_id: productId,
    quantity: parseInt(quantity),
  });
};
</script>
