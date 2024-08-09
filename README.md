# Product Management System

This project is a web-based application designed to manage products, categories, and their attributes. It provides an intuitive interface for performing CRUD (Create, Read, Update, Delete) operations on products, categories, and attributes, with a powerful search functionality implemented using Algolia.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Database Schema](#database-schema)
- [API Documentation](#api-documentation)
  - [API Endpoints](#api-endpoints)
    - [Products](#products)
    - [Categories](#categories)
    - [Attributes](#attributes)
- [Installation and Setup](#installation-and-setup)
- [Seeder Information](#seeder-information)
- [Usage Instructions](#usage-instructions)
- [Known Issues](#known-issues)
- [Future Enhancements](#future-enhancements)

## Project Overview

This application is built using Laravel 10, a popular PHP framework, and is aimed at managing products, categories, and attributes. The system includes an advanced search feature implemented using Algolia, allowing users to quickly find products based on various criteria.

**Note:** The Algolia search is implemented only for the Product model.

## Features

- **Product Management**: Create, view, update, and delete products.
- **Category Management**: Manage product categories.
- **Attribute Management**: Define and assign attributes to products.
- **Advanced Search**: Implemented using Algolia for fast and efficient product search.
- **Dashboard**: A user-friendly dashboard displaying all products, with options to search, filter, and manage them.
- **CRUD Operations**: Fully functional CRUD operations for products, categories, and attributes.

## Database Schema

The database schema consists of the following tables:

1. **Categories**
   - **Description**: Stores product categories.
   - **Relationships**: 
     - One-to-many relationship with Products (A category can have many products).

2. **Products**
   - **Description**: Stores product details.
   - **Relationships**:
     - Belongs to one Category.
     - Many-to-many relationship with Attributes through the `product_attributes` pivot table.

3. **Attributes**
   - **Description**: Stores product attributes such as color, size, etc.
   - **Relationships**:
     - Many-to-many relationship with Products through the `product_attributes` pivot table.

4. **Product_Attributes (Pivot Table)**
   - **Description**: Links Products with Attributes.
   - **Relationships**:
     - Connects Products and Attributes.

## API Documentation

The application provides a set of RESTful API endpoints to manage products, categories, and attributes. These APIs can be used to perform CRUD operations and are documented below.

### API Endpoints

#### Products
- **GET /api/products**: Retrieve a list of products.
- **POST /api/products**: Create a new product.
- **GET /api/products/{id}**: Retrieve a specific product.
- **PUT /api/products/{id}**: Update a specific product.
- **DELETE /api/products/{id}**: Delete a specific product.

#### Categories
- **GET /api/categories**: Retrieve a list of categories.
- **POST /api/categories**: Create a new category.
- **GET /api/categories/{id}**: Retrieve a specific category.
- **PUT /api/categories/{id}**: Update a specific category.
- **DELETE /api/categories/{id}**: Delete a specific category.

#### Attributes
- **GET /api/attributes**: Retrieve a list of attributes.
- **POST /api/attributes**: Create a new attribute.
- **GET /api/attributes/{id}**: Retrieve a specific attribute.
- **PUT /api/attributes/{id}**: Update a specific attribute.
- **DELETE /api/attributes/{id}**: Delete a specific attribute.

### Controller Structure

All API controllers are located in the `app/Http/Controller/API/` folder, following Laravel's best practices for organizing code.

### Interactive API Documentation

You can find the API documentation, including request examples and responses, in the Postman collection that is included with the project. The collection is published and accessible via a shared URL. This allows for easy access and interaction with the API.

## Installation and Setup

### Prerequisites

- **PHP 8.1+**
- **Composer**
- **MySQL**
- **Algolia Account** (for search functionality)

### Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   - Copy `.env.example` to `.env`
   - Set up your database credentials in the `.env` file.
   - Add the following Algolia API credentials in the `.env` file - Not ideal but still I gave the secret away for saving some time:

   ```
   ALGOLIA_APP_ID="B685VBDFZO"
   ALGOLIA_SECRET="44b9aaf8d2c0c1421afd1d29aa3ba789"
   ```

4. **Run Migrations and Seeders**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the Application**
   ```bash
   php artisan serve
   ```

6. **Access the Dashboard**
   - Open your browser and navigate to `http://localhost:8000`

## Seeder Information

The project includes seeders to populate the database with sample data. This allows you to quickly test and verify the functionality without manually entering data.

### Seeders Included

- **ProductSeeder**: Seeds the `products` table with sample products.
- **CategorySeeder**: Seeds the `categories` table with sample categories.
- **AttributeSeeder**: Seeds the `attributes` table with sample attributes.
- **DatabaseSeeder**: Runs all of the above seeders.

### Running the Seeders

After setting up your environment and running the migrations, you can populate the database by running the seeders:

1. **Run Migrations**:
   Make sure your database is properly set up and configured in the `.env` file. Run the following command to migrate the database schema:

   ```bash
   php artisan migrate
   ```

2. **Run All Seeders**:
   To run all the seeders and populate the database with sample data, use:

   ```bash
   php artisan db:seed
   ```

   This command will execute the `DatabaseSeeder`, which will, in turn, run all individual seeders (`ProductSeeder`, `CategorySeeder`, `AttributeSeeder`).

3. **Run Specific Seeder**:
   If you need to run a specific seeder, you can do so by specifying the seeder class:

   ```bash
   php artisan db:seed --class=ProductSeeder
   ```

### Verify Seeded Data

After running the seeders, you should see sample data in the respective database tables (`products`, `categories`, `attributes`). This seeded data will be used in the dashboard and API responses, allowing for immediate testing of the CRUD functionality.

## Usage Instructions

1. **Login/Register**: Use the provided links on the homepage to either log in or register.
2. **Dashboard Access**: After logging in, you'll be directed to the dashboard where you can manage products, categories, and attributes.
3. **Managing Products**: Use the sidebar to navigate to the products section. Here you can add new products, update existing ones, or delete them.
4. **Search Products**: Use the search bar on the dashboard to quickly find products using Algolia's search functionality, which is implemented in the Product model.
5. **Managing Categories and Attributes**: Similar to products, you can manage categories and attributes using the dedicated sections.

## Known Issues

- **Testing**: Unit and integration tests are not yet implemented. This is a planned enhancement.
- **UI Enhancements**: Some minor UI improvements can be made for better user experience.

## Future Enhancements

- **Unit and Integration Testing**: Comprehensive tests will be added to ensure the stability and reliability of the application.
- **UI/UX Improvements**: Additional improvements to the user interface will be considered based on user feedback.

---

This is intended to provide clear and precise guidelines to evaluators and other users, ensuring that they can set up and use your Laravel project with ease.
