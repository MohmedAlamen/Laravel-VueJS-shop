<template>
  <AdminLayout>
    <template #header>Dashboard</template>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Stats Cards -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Products</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">0</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Orders</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">0</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Users</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">0</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Revenue</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">$0</p>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
      <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <Link
          :href="route('admin.products.create')"
          class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center font-medium"
        >
          Add Product
        </Link>
        <Link
          :href="route('admin.categories.create')"
          class="px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-center font-medium"
        >
          Add Category
        </Link>
        <Link
          :href="route('admin.orders.index')"
          class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-center font-medium"
        >
          View Orders
        </Link>
        <Link
          :href="route('admin.users.index')"
          class="px-4 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition text-center font-medium"
        >
          Manage Users
        </Link>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>
