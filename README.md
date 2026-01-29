# BitHive - Community Forum

BitHive is a modern community discussion platform built with "Laravel". It provides a space for users to share ideas, ask questions, and engage in discussions with a clean, responsive interface.

## Key Features

* User Authentication: Secure Login and Registration system.
* Discussion Forum: Full Create, Read, Update, Delete (CRUD) functionality for community posts.
* Q&A Section: Dedicated space for asking questions and receiving answers.
* Dark/Light Mode: Dynamic theme toggling for better user experience.
* Responsive Design: Optimized for both desktop and mobile viewing.

## Tech Stack

* Framework: Laravel (PHP)
* Database: MySQL
* Frontend: Blade Templates, CSS (Bootstrap/Custom)
* Server: Apache (XAMPP)

## How to Run Locally

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/YourUsername/BitHive.git](https://github.com/DarkkCode/BitHive.git)
    cd BitHive
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    * Rename `.env.example` to `.env`
    * Update your database credentials in the `.env` file.

4.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Start the Server**
    ```bash
    php artisan serve
    ```

---
*Created by Vishesh.*
