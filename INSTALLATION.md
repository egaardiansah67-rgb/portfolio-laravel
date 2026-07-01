# Installation & Setup Guide

## Prerequisites

Before installing Portfolio Laravel, ensure you have the following installed:

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 16+ with NPM 7+
- **MySQL**: 5.7+ or PostgreSQL 10+
- **Git**: For cloning the repository
- **Nginx/Apache**: Web server (for production)

## Step-by-Step Installation

### 1. Clone the Repository

```bash
git clone https://github.com/egaardiansah67-rgb/portfolio-laravel.git
cd portfolio-laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file and configure:

```env
APP_NAME="Portfolio"
APP_ENV=local
APP_DEBUG=true
APP_KEY=
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@portfolio.local
MAIL_FROM_NAME="Portfolio"
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database

Using MySQL:
```sql
CREATE DATABASE portfolio_laravel;
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed Database (Optional)

```bash
php artisan db:seed
```

Or seed specific seeders:
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=SkillCategorySeeder
```

### 9. Build Frontend Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 10. Create Storage Symlink

```bash
php artisan storage:link
```

### 11. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## First Login

Default admin credentials (from seeder):
- **Email**: admin@example.com
- **Password**: password

⚠️ **Important**: Change these credentials immediately after first login!

## Dashboard Access

After login, access the admin dashboard:
```
http://localhost:8000/admin/dashboard
```

## File Permissions

Ensure proper permissions for storage and bootstrap directories:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

On production servers, use:
```bash
chown -R www-data:www-data /path/to/portfolio
chmod -R 775 /path/to/portfolio/storage
```

## Troubleshooting

### Composer Errors

If you encounter composer errors, try:
```bash
composer clear-cache
composer install --no-cache
```

### Node Dependencies Issues

Clear npm cache:
```bash
npm cache clean --force
npm install
```

### Database Connection Error

Verify your `.env` database credentials:
```bash
php artisan tinker
DB::connection()->getPdo();
```

### Storage Link Not Working

Delete and recreate:
```bash
rm public/storage
php artisan storage:link
```

### Permission Denied Errors

Fix permissions:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Production Deployment

### 1. Server Setup

Install on production server:
```bash
sudo apt-get update
sudo apt-get install php8.2 php8.2-{fpm,cli,mysql,curl,gd,mbstring,xml,pdo,zip}
sudo apt-get install mysql-server nginx
sudo apt-get install nodejs npm
sudo apt-get install composer
```

### 2. Clone Repository

```bash
cd /var/www
sudo git clone https://github.com/egaardiansah67-rgb/portfolio-laravel.git
cd portfolio-laravel
```

### 3. Install Dependencies

```bash
sudo composer install --no-dev --optimize-autoloader
sudo npm install && npm run build
```

### 4. Environment Setup

```bash
sudo cp .env.example .env
sudo nano .env  # Configure for production
sudo php artisan key:generate
```

### 5. Database Setup

```bash
sudo php artisan migrate --force
sudo php artisan db:seed --force
```

### 6. Optimize for Production

```bash
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache
sudo php artisan optimize
```

### 7. Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/portfolio-laravel
sudo chmod -R 775 /var/www/portfolio-laravel/storage
sudo chmod -R 775 /var/www/portfolio-laravel/bootstrap/cache
```

### 8. Nginx Configuration

Create `/etc/nginx/sites-available/portfolio`:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/portfolio-laravel/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:
```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 9. SSL Certificate (Let's Encrypt)

```bash
sudo apt-get install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 10. Cron Job for Laravel Scheduler

Add to crontab:
```bash
* * * * * cd /var/www/portfolio-laravel && php artisan schedule:run >> /dev/null 2>&1
```

## Maintenance

### Regular Updates

```bash
composer update
npm update
php artisan migrate
```

### Backup Database

```bash
mysqldump -u username -p database_name > backup.sql
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Support

For issues or questions:
1. Check the [main README](README.md)
2. Review [API Documentation](API.md)
3. Create an issue on GitHub
4. Contact: egaardiansah67@gmail.com

---

**Happy coding!** 🚀
