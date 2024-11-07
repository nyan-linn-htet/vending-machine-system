# Vending Machine System

This is a Vending Machine System built with Laravel 10. It allows you to manage users, products, transactions.

## Admin Features

### User Management

- Filter for user by role (admin, user).
- View a list of users.
- Add new users.
- Edit existing user information.
- Delete user.

### Role Management

- View a list of roles.
- Add new role.
- Edit existing role information.
- Delete role.

### Product Management

- Search for products by name.
- View a list of products.
- Add new products.
- Edit existing product information.
- Delete product.

### Transaction Management

- View a list of transactions made by users.
- View transaction's detail.

## Admin Features

### Purchase

- View a list of products.
- Add the products to the cart.
- Buy the product.

### Transaction

- View a list of transaction.
- View transaction's detail.

## Installation

Follow these steps to install and set up the Vending Machine System:

1. Clone the repository:

   ```bash
   git clone https://github.com/nyan-linn-htet/vending-machine-system.git

2. Navigate to the project directory:

    ```bash
    cd vending-machine-system

3. Install the project dependencies using Composer:

    ```bash
    composer install

4. Create a .env file by copying the example:

    ```bash
    cp .env.example .env

5. Generate a new application key:

    ```bash
    php artisan key:generate

6. Configure your database connection in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=your-database-host
    DB_PORT=3306
    DB_DATABASE=your-database-name
    DB_USERNAME=your-database-username
    DB_PASSWORD=your-database-password

7. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed

8. Start the development server:

    ```bash
    php artisan serve

    npm run dev

9. Access the application in your web browser at http://localhost:8000.

10. You can log in to the admin panel using the default administrator account:

    Email: admin@gmail.com
    Password: admin123

11. You can log in to the dashboard using the default user account:

    Email: user@gmail.com
    Password: user1234
