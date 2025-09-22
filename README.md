## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- NPM or Yarn
- MySQL 

## 🛠️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/iamwaleedmirza/test-task.git
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
# or
yarn install
```

### 4. Environment Setup

```bash
cp .env.example .env
```

Update your `.env` file with your database credentials and other configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

## 🌱 Database Seeding

This application includes database seeders to populate your database with sample data.

### Run All Seeders

```bash
php artisan db:seed
```

### Fresh Migration with Seeding



### Available Seeders

- `DatabaseSeeder` - Main seeder that calls all other seeders
- `PollSeeder` - Creates sample users
- `TaskSeeder` - Creates user roles and permissions
- Add your custom seeders here...



### Run All Tests

```bash
php artisan test
```


### Development Server

Start the Laravel development server:

```bash
php artisan serve
```

In a separate terminal, run the Vite development server for hot reloading:

```bash
npm run dev
```

Visit `http://localhost:8000` in your browser.

