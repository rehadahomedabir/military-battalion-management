# Military Battalion Management System - Installation Guide

## System Requirements

- PHP 8.4 or higher
- Composer
- MySQL 5.7+ or PostgreSQL 9.6+
- Node.js (optional, for frontend assets)
- Git

## Installation Steps

### 1. Clone Repository

```bash
git clone https://github.com/rehadahomedabir/military-battalion-management.git
cd military-battalion-management
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=military_battalion
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Setup

Create database:

```bash
mysql -u root -p
create database military_battalion;
exit;
```

Run migrations:

```bash
php artisan migrate
```

Seed database with initial data:

```bash
php artisan db:seed
```

### 6. Create Storage Symlink

```bash
php artisan storage:link
```

### 7. Set Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit: http://localhost:8000

## Default Credentials

After seeding, login with:

- **Email**: admin@example.com
- **Password**: password

## Post-Installation

### Install Frontend Assets (Optional)

```bash
npm install
npm run dev
```

### Clear Cache

```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Create User Account

```bash
php artisan tinker
>>> $user = new App\Models\User();
>>> $user->name = 'Your Name';
>>> $user->email = 'your@email.com';
>>> $user->password = Hash::make('password');
>>> $user->save();
>>> $user->assignRole('super_admin');
```

## Troubleshooting

### Permission Issues

```bash
sudo chown -R $USER:$USER .
chmod -R 755 .
chmod -R 777 storage bootstrap/cache
```

### Database Connection Error

Verify `.env` database configuration and ensure MySQL service is running.

### Missing Key Error

```bash
php artisan key:generate
```

## Production Deployment

### 1. Set Environment to Production

```bash
APP_ENV=production
APP_DEBUG=false
```

### 2. Optimize Application

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Run Migrations on Server

```bash
php artisan migrate --force
```

### 4. Set Proper Permissions

```bash
chown -R www-data:www-data .
chmod -R 755 .
chmod -R 777 storage bootstrap/cache
```

### 5. Setup Web Server (Nginx Example)

```nginx
server {
    listen 80;
    server_name your_domain.com;
    root /path/to/project/public;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).*$ {
        deny all;
    }
}
```

### 6. Enable HTTPS (Let's Encrypt)

```bash
sudo apt-get install certbot python3-certbot-nginx
sudo certbot --nginx -d your_domain.com
```

## Database Backup

### Create Backup

```bash
mysqldump -u root -p military_battalion > backup_$(date +%Y%m%d).sql
```

### Restore Backup

```bash
mysql -u root -p military_battalion < backup_20260609.sql
```

## Support

For issues or questions, please create an issue on GitHub or contact the development team.
