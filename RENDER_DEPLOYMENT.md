# Render.com Deployment Guide with Azure Database

## Azure MySQL Database Setup

Since you're using Azure Database for MySQL, you'll need to configure the connection properly:

### 1. Get Azure Database Connection Details

From your Azure Database for MySQL dashboard, get:
- Server name (e.g., `yourserver.mysql.database.azure.com`)
- Database name
- Username (usually in format `username@servername`)
- Password
- Port (usually 3306)

### 2. Configure Environment Variables in Render

Set these environment variables in your Render service:

```bash
DB_CONNECTION=mysql
DB_HOST=yourserver.mysql.database.azure.com
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username@your-server-name
DB_PASSWORD=your-password

# Azure MySQL SSL Configuration
# The SSL certificate is included in the project, so leave MYSQL_ATTR_SSL_CA empty
MYSQL_ATTR_SSL_VERIFY_SERVER_CERT=false
```

**Important Notes for Azure MySQL:**
- Username format: `username@servername` (include the @servername part)
- SSL is required for Azure Database connections
- Make sure to allow connections from all IP addresses (0.0.0.0-255.255.255.255) in Azure firewall rules for Render deployment

### 3. Azure Firewall Configuration

In your Azure Database for MySQL:
1. Go to "Connection Security"
2. Add firewall rule:
   - Rule name: `Render-All-IPs`
   - Start IP: `0.0.0.0`
   - End IP: `255.255.255.255`
3. Make sure "Allow access to Azure services" is ON
4. Save the configuration

## Required Environment Variables for Render.com

Set these in your Render service's environment variables:

```bash
APP_NAME=PHP-Bank
APP_ENV=production
APP_KEY=your-app-key-here
APP_DEBUG=false
APP_URL=https://phpbank.onrender.com

# Database (choose one option above)
DB_CONNECTION=pgsql  # or mysql
DB_HOST=your-database-host
DB_PORT=5432  # or 3306 for MySQL
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database

# Queue
QUEUE_CONNECTION=database

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Generate Application Key

Run this command in your local environment and copy the key:

```bash
php artisan key:generate --show
```

Then set `APP_KEY` in Render with the generated key.

## Build Command for Render

Set your build command in Render to:

```bash
composer install --no-dev --optimize-autoloader && npm install && npm run build && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Start Command for Render

Set your start command to:

```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

## Deployment Steps

1. Push your code to GitHub
2. Connect your GitHub repo to Render
3. Set the environment variables listed above
4. Set the build and start commands
5. Deploy!

## Troubleshooting

### Database Connection Issues
- Make sure all DB_* environment variables are set correctly
- For MySQL, ensure SSL is configured properly
- For PostgreSQL, the connection should work out of the box

### Asset Issues
- Make sure `npm run build` is included in your build command
- Verify that the `public/build` directory is being created during build

### SSL/HTTPS Issues
- The app should automatically detect HTTPS when deployed to Render
- If you still see mixed content errors, check that all environment variables are set correctly