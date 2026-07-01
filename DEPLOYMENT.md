# Deployment Guide

## Pre-Deployment Checklist

- [ ] Update `.env` for production
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Build frontend assets: `npm run build`
- [ ] Test locally in production mode
- [ ] Backup database
- [ ] Create recovery plan
- [ ] Update DNS records
- [ ] Configure SSL certificate
- [ ] Setup monitoring

## Deployment Methods

### Option 1: Traditional VPS/Dedicated Server

#### Server Requirements

```bash
# Ubuntu 20.04 / 22.04
sudo apt-get update && sudo apt-get upgrade

# PHP 8.2
sudo apt-get install php8.2 php8.2-fpm php8.2-cli php8.2-curl php8.2-gd \
  php8.2-mysql php8.2-mbstring php8.2-xml php8.2-zip php8.2-pdo

# MySQL
sudo apt-get install mysql-server

# Nginx
sudo apt-get install nginx

# Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install nodejs

# Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

#### Deploy Steps

1. **Clone Repository**
```bash
cd /var/www
sudo git clone https://github.com/egaardiansah67-rgb/portfolio-laravel.git
cd portfolio-laravel
sudo chown -R $USER:$USER .
```

2. **Install Dependencies**
```bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
```

3. **Configure Environment**
```bash
cp .env.example .env
# Edit .env with production settings
sudo php artisan key:generate
```

4. **Database Setup**
```bash
sudo mysql -e "CREATE DATABASE portfolio CHARACTER SET UTF8MB4 COLLATE utf8mb4_unicode_ci;"
sudo php artisan migrate --force
sudo php artisan db:seed --force
```

5. **Permissions**
```bash
sudo chown -R www-data:www-data /var/www/portfolio-laravel
sudo chmod -R 775 storage bootstrap/cache
```

6. **Configure Nginx**

Create `/etc/nginx/sites-available/portfolio`:

```nginx
upstream phpfpm {
    server unix:/var/run/php/php8.2-fpm.sock;
}

server {
    listen 80;
    listen [::]:80;
    server_name portfolio.local www.portfolio.local;
    root /var/www/portfolio-laravel/public;
    index index.php index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1000;
    gzip_types text/plain text/css text/xml text/javascript 
               application/x-javascript application/xml+rss;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass phpfpm;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

7. **SSL Certificate (Let's Encrypt)**
```bash
sudo apt-get install certbot python3-certbot-nginx
sudo certbot --nginx -d portfolio.local -d www.portfolio.local
```

8. **Optimize Production**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Option 2: Docker

#### Dockerfile

```dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip unzip mysql-client

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo_mysql mbstring exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
```

#### Docker Compose

```yaml
version: '3.8'

services:
  app:
    build: .
    ports:
      - "9000:9000"
    environment:
      - APP_KEY=
      - DB_HOST=mysql
      - DB_DATABASE=portfolio
      - DB_USERNAME=portfolio
      - DB_PASSWORD=secret
    volumes:
      - ./:/app
    depends_on:
      - mysql

  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/app
      - ./nginx.conf:/etc/nginx/nginx.conf
    depends_on:
      - app

  mysql:
    image: mysql:8
    environment:
      - MYSQL_DATABASE=portfolio
      - MYSQL_USER=portfolio
      - MYSQL_PASSWORD=secret
      - MYSQL_ROOT_PASSWORD=root
    volumes:
      - dbdata:/var/lib/mysql

volumes:
  dbdata:
```

Deploy:
```bash
docker-compose up -d
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### Option 3: Heroku

1. **Install Heroku CLI**
```bash
curl https://cli-assets.heroku.com/install.sh | sh
```

2. **Create Procfile**
```
web: vendor/bin/heroku-php-nginx -C nginx.conf public/
scheduler: php artisan schedule:work
```

3. **Configure for Heroku**
```bash
heroku create portfolio-app
heroku addons:create cleardb:ignite
heroku config:set APP_KEY=$(php artisan key:generate --show)
git push heroku main
```

### Option 4: Shared Hosting (cPanel)

1. **Upload Files**
   - Upload via FTP/File Manager to `public_html`
   - Create `storage` folder outside public_html
   - Create `.env` file

2. **Setup Database**
   - Use cPanel → MySQL Databases
   - Import database

3. **Run Migrations**
   - Via SSH: `php artisan migrate`
   - Or use PHP script in public folder

4. **Configure `.htaccess`**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```

## Post-Deployment

### 1. Verify Installation

```bash
php artisan about
php artisan storage:link
```

### 2. Setup Monitoring

- Monitor error logs: `tail -f storage/logs/laravel.log`
- Setup uptime monitoring (UptimeRobot, Pingdom)
- Configure application monitoring (New Relic, DataDog)

### 3. Backup Strategy

**Automated Database Backup**:
```bash
0 2 * * * mysqldump -u user -p password database > /backups/db_$(date +\%Y\%m\%d).sql
```

**Backup Script**:
```bash
#!/bin/bash
BACKUP_DIR="/backups/portfolio"
DATE=$(date +%Y-%m-%d)

# Database
mysqldump -u root -ppassword portfolio > $BACKUP_DIR/db_$DATE.sql

# Files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/portfolio-laravel

# Keep only last 30 days
find $BACKUP_DIR -mtime +30 -delete
```

### 4. Email Configuration

Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@portfolio.com
```

### 5. Setup Cron Jobs

```bash
# Laravel scheduler
* * * * * cd /var/www/portfolio-laravel && php artisan schedule:run >> /dev/null 2>&1

# Database optimization
0 3 * * 0 cd /var/www/portfolio-laravel && php artisan db:optimize

# Clear cache
0 * * * * cd /var/www/portfolio-laravel && php artisan cache:clear
```

## Troubleshooting

### 500 Error
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
chmod -R 775 storage bootstrap/cache
```

### Database Connection Error
```bash
php artisan migrate --force --verbose
# Check .env database settings
```

### White Screen
- Check error logs: `storage/logs/laravel.log`
- Enable debug: Set `APP_DEBUG=true` temporarily
- Check PHP errors: Check web server logs

### Performance Issues
```bash
# Optimize autoloader
composer dump-autoload --optimize

# Cache routes
php artisan route:cache

# Cache config
php artisan config:cache
```

## Maintenance Mode

```bash
# Enable
php artisan down

# Disable
php artisan up

# With message
php artisan down --message="Upgrading database"
```

## Security Recommendations

1. **Update Regularly**
```bash
composer update
npm update
```

2. **SSL/TLS**
   - Always use HTTPS
   - Keep certificates updated

3. **Environment Variables**
   - Never commit `.env` to Git
   - Use strong passwords
   - Rotate keys periodically

4. **File Permissions**
   - Storage should not be web-accessible
   - Restrict admin folder

5. **Database**
   - Regular backups
   - Use strong passwords
   - Limit database user privileges

6. **Firewall**
   - Whitelist trusted IPs
   - Block unnecessary ports
   - Use rate limiting

---

**Questions?** Check the [Installation Guide](INSTALLATION.md) or [API Documentation](API.md)
