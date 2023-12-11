IPS Assignment

This repository contains the code for the Individual Project Submission (IPS) assignment.
Project Overview
The project aims to develop a basic web application for a school photography club, focusing on user management, achievement tracking, and lesson access control. The application will feature functionalities like:
* User registration and login
* Achievement system with different types and unlock conditions
* Lesson management with access control based on unlocked achievements
* User progress tracking and achievement history
* Basic interface for managing users, achievements, and lessons
Technologies Used
The project is built using the following technologies:
* Backend: Laravel framework
* Database: MySQL
* Front-end: Laravel Blade templates

Installation and Setup
1. Clone the repository:
```git clone https://github.com/NomanIlyas/IPS-assignement```
2. Move to the project directory:
``` cd IPS-assignement ```
3. Install dependencies:
```composer install```
4. Generate a new application key:
```php artisan key:generate```
5. Create a database and run migrations:
```php artisan migrate```
6. Seed the database with initial data:
```php artisan db:seed```
7. Start the application:
```php artisan serve```
8. Access the application in your web browser at http://localhost:8000.
Usage
5. Track your progress and achievement history:
* See a list of all achievements and their unlock status.
6. (For authorized users) Manage users, achievements, and lessons:
* Use the provided interface for administrative tasks.
Contribute
This is an open-source project and contributions are welcome! Feel free to fork the repository, create pull requests, and share your improvements.
License
This project is licensed under the MIT License.
