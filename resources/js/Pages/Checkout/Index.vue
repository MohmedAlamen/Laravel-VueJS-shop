<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $t('checkout') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Checkout Form -->
          <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form @submit.prevent="submitCheckout">
              <!-- Customer Information -->
              <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $t('customer_info') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      {{ $t('full_name') }}
                    </label>
                    <input
                      id="customer_name"
                      v-model="form.customer_name"
                      type="text"
                      required
                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </div>
                  <div>
                    <label for="customer_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      {{ $t('email') }}
                    </label>
                    <input
                      id="customer_email"
                      v-model="form.customer_email"
                      type="email"
                      required
                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </div>
                </div>
              </div>

              <!-- Shipping Address -->
              <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $t('shipping_address') }}</h3>
                <textarea
                  v-model="form.shipping_address"
                  required
                  rows="4"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  :placeholder="$t('enter_address')"
                ></textarea>
              </div>

              <!-- Payment Method -->
              <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $t('payment_method') }}</h3>
                <div class="space-y-2">
                  <label class="flex items-center">
                    <input
                      v-model="form.payment_method"
                      type="radio"
                      value="credit_card"
                      class="mr-2"
                    />
                    <span class="text-gray-700 dark:text-gray-300">{{ $t('credit_card') }}</span>
                  </label>
                  <label class="flex items-center">
                    <input
                      v-model="form.payment_method"
                      type="radio"
                      value="paypal"
                      class="mr-2"
                    />
                    <span class="text-gray-700 dark:text-gray-300">{{ $t('paypal') }}</span>
                  </label>
                  <label class="flex items-center">
                    <input
                      v-model="form.payment_method"
                      type="radio"
                      value="bank_transfer"
                      class="mr-2"
                    />
                    <span class="text-gray-700 dark:text-gray-300">{{ $t('bank_transfer') }}</span>
                  </label>
                </div>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                :disabled="processing"
                class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold disabled:opacity-50"
              >
                {{ processing ? $t('processing') : $t('place_order') }}
              </button>
            </form>
          </div>

          <!-- Order Summary -->
          <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow p-6 h-fit">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $t('order_summary') }}</h3>

            <!-- Cart Items -->
            <div class="space-y-3 border-b pb-4 mb-4">
              <div v-for="item in cartItems" :key="item.id" class="flex justify-between text-sm text-gray-700 dark:text-gray-300">
                <span>{{ isArabic ? item.product.name_ar : item.product.name_en }} x{{ item.quantity }}</span>
                <span>${{ (item.product.price * item.quantity).toFixed(2) }}</span>
              </div>
            </div>

            <!-- Totals -->
            <div class="space-y-2 text-gray-700 dark:text-gray-300 mb-4">
              <div class="flex justify-between">
                <span>{{ $t('subtotal') }}</span>
                <span>${{ cartTotal.toFixed(2) }}</span>
              </div>
              <div class="flex justify-between">
                <span>{{ $t('shipping') }}</span>
                <span>{{ $t('free') }}</span>
              </div>
            </div>

            <!-- Final Total -->
            <div class="flex justify-between font-bold text-lg text-gray-900 dark:text-gray-100 pt-4 border-t">
              <span>{{ $t('total') }}</span>
              <span>${{ cartTotal.toFixed(2) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { computed, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  cartItems: Array,
  cartTotal: Number,
  user: Object,
});

const isArabic = computed(() => localStorage.getItem('language') === 'ar');
const processing = reactive({ value: false });

const form = reactive({
  customer_name: '',
  customer_email: '',
  shipping_address: '',
  payment_method: 'credit_card',
});

const submitCheckout = () => {
  processing.value = true;
  router.post(route('checkout.store'), form, {
    onFinish: () => {
      processing.value = false;
    },
  });
};
</script>
