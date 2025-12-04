# Laravel + Vue.js E-commerce Shop

This project is a fully functional, modern, and responsive e-commerce application built with the powerful combination of Laravel for the backend and Vue.js (via Inertia.js) for a single-page application (SPA) experience.

## 🚀 Features

The application is designed to be a complete solution for an online store, incorporating the following key features:

*   **Full Responsiveness:** Built with Tailwind CSS to ensure a seamless experience on all devices (mobile, tablet, desktop).
*   **Bilingual Support (i18n):** Full support for both **English** and **Arabic (RTL)** languages, with easy switching and automatic direction adjustment.
*   **Dark Mode:** A toggleable dark mode feature for improved user comfort.
*   **Product Catalog:** Display of products with categorization and detail pages.
*   **User Authentication:** Secure registration, login, and profile management (via Laravel Breeze).
*   **Extensible Architecture:** The project is structured to easily integrate advanced features like:
    *   Shopping Cart and Checkout Flow
    *   Admin Panel for CRUD operations (Products, Categories, Orders)
    *   Reviews and Ratings
    *   Wishlist functionality

## 🛠️ Technology Stack

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Backend** | Laravel (PHP) | Robust framework for API, routing, and database management. |
| **Frontend** | Vue.js 3 | Progressive JavaScript framework for building user interfaces. |
| **Adapter** | Inertia.js | Connects Laravel and Vue.js for a modern SPA feel. |
| **Styling** | Tailwind CSS | Utility-first CSS framework for rapid, responsive design. |
| **Database** | SQLite (Local) | Used for development and easy setup. |

## ⚙️ Local Setup and Installation

Follow these steps to get the project running on your local machine:

### Prerequisites

*   PHP >= 8.1
*   Composer
*   Node.js >= 18.x
*   npm or yarn

### Installation Steps

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/MohmedAlamen/Laravel-VueJS-shop.git
    cd Laravel-VueJS-shop
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node Dependencies:**
    ```bash
    npm install
    ```

4.  **Configure Environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *(Note: The provided `.env` is pre-configured to use SQLite.)*

5.  **Database Setup:**
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```
    This command creates the database file, runs all migrations, and seeds the database with sample products and categories.

6.  **Build Frontend Assets:**
    ```bash
    npm run build
    ```

7.  **Start the Development Server:**
    ```bash
    php artisan serve
    ```

The application will be accessible at `http://127.0.0.1:8000`.

## 📸 Screenshots

The application is fully responsive and supports both LTR (English) and RTL (Arabic) layouts.

| Page | English (LTR) | Arabic (RTL) |
| :--- | :--- | :--- |
| **Product Listing** | ![Placeholder for English Product Listing](https://via.placeholder.com/600x400?text=Product+Listing+-+English) | ![Placeholder for Arabic Product Listing](https://via.placeholder.com/600x400?text=Product+Listing+-+Arabic) |
| **Product Detail** | ![Placeholder for English Product Detail](https://via.placeholder.com/600x400?text=Product+Detail+-+English) | ![Placeholder for Arabic Product Detail](https://via.placeholder.com/600x400?text=Product+Detail+-+Arabic) |
| **Dark Mode** | ![Placeholder for Dark Mode](https://via.placeholder.com/600x400?text=Dark+Mode+View) | |

***
*Note: The screenshots above are placeholders. Please run the application locally and replace these images with actual screenshots of the running application.*
***

## 📝 Project Extension Plan

A detailed plan for extending this project with advanced features (Admin Panel, Cart, Reviews, Payment Integration) is available in the `ecommerce_extension_plan.md` file.
