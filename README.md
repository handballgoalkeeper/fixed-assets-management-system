# 🏢 Fixed Asset Management System

![PHP](https://img.shields.io/badge/PHP-8.2-blue) ![Laravel](https://img.shields.io/badge/Laravel-11.9-blue) ![MySQL](https://img.shields.io/badge/MySQL-8.0-orange) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-blueviolet)

I'm excited to present a **Fixed Asset Management System** built with **PHP 8.2**, **Laravel 11.9**, **MySQL**, and **Bootstrap**. This web application helps organizations track and manage fixed assets throughout their lifecycle—from acquisition and usage to disposal. The system includes core features for asset management, maintenance tracking, depreciation, and reporting.

I hope you find this project as exciting to explore as I did to develop it! 😊

## 🎯 Table of Contents

1. [✨ Core Features](#-core-features)
2. [🔧 Implementation Details](#-implementation-details)
3. [🛠️ Tech Stack](#-tech-stack)
4. [🚀 Deployment](#-deployment)

## ✨ Core Features

- **Asset Management**  
  🏢 Manage IT fixed assets within the organization. This includes adding, editing, as well as tracking important details like asset type, purchase date and location.

- **Asset Assignment**  
  🔑 Assign assets to employees, departments, or locations. Keep a historical record of asset assignments for accountability and reporting purposes.

- **Maintenance Tracking**  
  🛠️ Track maintenance schedules and logs for each asset. Set up automated reminders for upcoming maintenance tasks and repairs.

- **Reporting**  
  📊 Generate detailed reports to analyze asset performance, utilization, depreciation, maintenance history, and more. Admins can export reports to CSV format for further analysis.

---

## 🔧 Implementation Details

- **Laravel Framework**  
  🚀 The application is built using **Laravel 11.9**, a modern PHP framework that provides a clean and elegant syntax, making it easier to develop web applications. Laravel handles routing, database queries, authentication, and much more.

- **Database**  
  🗄️ MySQL is used to store asset data, user credentials, maintenance logs. Laravel's Eloquent ORM simplifies database interactions, while migrations help manage the database schema.

- **Form Handling**  
  📝 Laravel handles form submissions for managing assets, maintenance tasks, and user assignments. Data validation is done using Laravel’s built-in validation methods to ensure proper input.

- **Session Management**  
  🧩 Laravel’s built-in session management and authentication features are used to manage user login states and control access levels. Only authorized users can manage assets or view reports.

- **Security**  
  🔐 Security best practices are integrated into the application, including password hashing (via Laravel's `bcrypt()` function), CSRF protection, and SQL injection prevention using Eloquent and query builder.

- **User Interface**  
  🎨 The user interface is built using **HTML**, **CSS**, and **JavaScript**, with **Bootstrap 5.3** to ensure a responsive and modern design. The UI is designed to be intuitive, making it easy for users to interact with the system on any device.

---

## 🛠️ Tech Stack

- **PHP 8.2**: The application is developed using PHP 8.2, which ensures improved performance and modern features.
- **Laravel 11.9**: A robust, modern PHP framework for rapid application development, handling routes, database interactions, authentication, and more.
- **MySQL 8.0**: A relational database management system for storing and querying asset and user data.
- **Bootstrap 5.3**: A framework for building responsive, mobile-first websites quickly.
- **JavaScript**: For enhancing the interactivity of the user interface.

---

## 🚀 Deployment

To deploy and run this PHP/Laravel application, follow the steps below:

1. **Install Dependencies**
    - Clone the repository:
      ```bash
      git clone https://github.com/yourusername/fixed-asset-management.git
      cd fixed-asset-management
      ```

2. **Install Composer**
    - Run the following command to install the required PHP dependencies:
      ```bash
      composer install
      ```

3. **Set Up Environment**
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your database credentials and other settings.

4. **Generate Application Key**
    - Laravel requires an application key to be set:
      ```bash
      php artisan key:generate
      ```

5. **Run Migrations**
    - Create the database and run the migrations to set up the tables:
      ```bash
      php artisan migrate
      ```

6. **Serve the Application**
    - Use Laravel's built-in server for local development:
      ```bash
      php artisan serve
      ```
    - Access the application at `http://127.0.0.1:8000`.

---

## 📝 License

This project is licensed under the [MIT License](LICENSE). See the [LICENSE](LICENSE) file for details.

## 🤝 Contributing

Contributions are welcome! Feel free to submit pull requests, report issues, or suggest new features.

---
