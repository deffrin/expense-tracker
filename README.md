## Expense Tracker

Expense Tracker helps to track daily expenses of a user

Features:

- **What user can do?:**
    - Users can register, log in, and log out of the application.
  
- **Expense Management:**
    - Users can add expenses with the following information:
        - Amount (Float)
        - Description (Text)
        - Category (Predefined list of categories)
        - Spent At (Date Timestamp)
    - Users can view, edit, and delete their expenses.
  
- **Reports:**
    - Users can view reports such as:
        - Total expenses per category for a specific month. 📈
        - Average daily expenses for a specific month. 📊


## Run For Development Env Setup

```bash

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed --class=CategorySeeder 

composer run dev

```
