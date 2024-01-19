Multi-Lingual Travel Agency Management System
=============================================

This repository houses a comprehensive and user-friendly travel agency management system built with Laravel. It allows users to join trips, select specialized packages, rate their experiences, and communicate with the agency through a contact form. With an intuitive admin dashboard, the agency can efficiently manage users, trips, packages, ratings, and blog content. The system supports both English and Arabic languages, providing a seamless experience for all users.

### Key Features

*   **User-Friendly Interface**: The website offers a user-friendly interface in both English and Arabic languages. Users can easily navigate through available trips and packages, manage reservations, and submit ratings.
*   **Trip and Package Selection**: Users have the flexibility to join existing trips or choose from a range of curated packages with additional features. This enables users to customize their travel experiences based on their preferences.
*   **Rating and Review System**: Users can rate their trips and provide valuable feedback to help others make informed decisions. The system promotes transparency and allows users to share their experiences with the community.
*   **Admin Dashboard**: The admin dashboard provides a suite of powerful tools for managing the travel agency. Administrators can control user management, trip and package management, ratings and reviews, and blog content. The dashboard offers additional features to streamline agency operations. Admin credentials: Email: `admin@trips.com`, Password: `password`.
*   **User Dashboard**: The user dashboard allows users to manage their reservations and ratings. Users can view and manage their reservations, submit and manage ratings for trips. To log in, go to PHPMyAdmin, access the database, find the `users` table, choose an email, and use the password `password` to log in.
*   **Contact Form Management**: The system includes a contact form for users to communicate directly with the agency. Admins have full control over managing and responding to messages received through the contact form, ensuring effective communication with users.
*   **Strong Profile Management**: The system provides a robust profile management feature for users. Users can access their profiles through the user dashboard

### Getting Started

To set up and run the project on your local machine, follow these steps:

1.  **Download the Vendor**: After cloning the repository, navigate to the project's root directory and run `composer install` to download the necessary dependencies.
2.  **Create a New Database**: Create a new database on your local development environment.
3.  **Configure Database Credentials**: Open the `.env` file in the project's root directory and update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` fields with your database details.
4.  **Run Database Migrations and Seeders**: Run `php artisan migrate:fresh --seed` in the project's root directory to execute the necessary database migrations and seed the database with sample data.
5.  **Start the Development Server**: Run `php artisan serve` to start the development server.
6.  **Access User Dashboard**: After the server is running, you can access the user dashboard by going to PHPMyAdmin, accessing the database, finding the 'users' table, choosing an email, and using the password 'password' to log in. From the user dashboard, users can access and manage their profiles.
7.  **Access Admin Dashboard**: After the server is running, you can access the admin dashboard using the following credentials: Email:`admin@trips.com`, Password: `password`. From the admin dashboard, admins can access and manage their profiles.

Once the server is running and you have logged in to the user dashboard, you can further explore the travel agency management system by opening the provided URL in your web browser.

Whether you're a travel agency looking to streamline operations or a developer interested in building a similar system, this repository provides a solid foundation to get started.
