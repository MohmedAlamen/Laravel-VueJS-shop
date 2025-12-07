import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

export const useCartStore = defineStore('cart', () => {
  const items = ref([]);

  // Load cart from local storage on initialization
  const loadCart = () => {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
      items.value = JSON.parse(savedCart);
    }
  };

  // Save cart to local storage
  const saveCart = () => {
    localStorage.setItem('cart', JSON.stringify(items.value));
  };

  const total = computed(() => {
    return items.value.reduce((sum, item) => sum + item.price * item.quantity, 0);
  });

  const addItem = (product, quantity = 1) => {
    const existingItem = items.value.find(item => item.product_id === product.id);

    if (existingItem) {
      existingItem.quantity += quantity;
    } else {
      items.value.push({
        product_id: product.id,
        name_en: product.name_en,
        name_ar: product.name_ar,
        slug: product.slug,
        price: product.price,
        image: product.image,
        quantity: quantity,
      });
    }
    saveCart();
  };

  const removeItem = (productId) => {
    items.value = items.value.filter(item => item.product_id !== productId);
    saveCart();
  };

  const updateQuantity = (productId, quantity) => {
    const item = items.value.find(item => item.product_id === productId);
    const newQuantity = parseInt(quantity);

    if (item && newQuantity > 0) {
      item.quantity = newQuantity;
      saveCart();
    } else if (item && newQuantity <= 0) {
      removeItem(productId);
    }
  };

  const clearCart = () => {
    items.value = [];
    saveCart();
  };

  // Initial load
  loadCart();

  return {
    items,
    total,
    addItem,
    removeItem,
    updateQuantity,
    clearCart,
  };
});
