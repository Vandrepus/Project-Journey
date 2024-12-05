# JourneyHub

## Prerequisites

Ensure you have the following installed on your system:

- **PHP 8.2** or higher  
- A database environment such as **Laragon**, **XAMPP**, or **MySQL** (Recommended: **Laragon**)  
- **Node.js** (for frontend development)  

---

## Installation and Setup

### 1. Clone the Repository

Run the following command to clone the repository:

```bash
git clone https://github.com/Vandrepus/Project-Journey.git
cd Project-app
```
### 2. Install Backend Dependencies
Run the following command to install PHP dependencies using Composer:

```bash
composer install
```
### 3. Configure Environment
Copy the .env.example file to .env and configure your database connection:

```bash
cp .env.example .env
```
Update the .env file with your database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

Generate the application key:

```bash
php artisan key:generate
```

### 4.Install Frontend Dependencies
Run the following commands to set up the frontend:

```bash
npm install
```

To compile assets for development, run:

```bash
npm run dev
```

### 5.Migrate the Database

In a new terminal, run the migrations to set up your database schema:

```bash
php artisan migrate
```

### 6. Start the Development Server
Start the Laravel development server:

```bash
php artisan serve
```
---
## Access the Application
Once the server is running:
* Visit the application in your browser at `http://127.0.0.1:8000`.
---

## Project Workflow
* Frontend Development: Use npm run dev for real-time updates during development.
* Database Changes: Run migrations with php artisan migrate.
* Run the Application: Ensure both npm run dev and php artisan serve are running for a seamless experience.
