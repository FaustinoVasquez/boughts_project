# Boughts Project

Laravel application for managing product inventory, marketplace listings, and clean launch operations.

## Current Stack

- **PHP**: 8.1.33
- **Laravel**: 8.83.29
- **Database**: SQL Server (ODBC 18)
- **Cache**: Redis 7
- **Web Server**: Nginx + PHP-FPM
- **Container**: Docker

## Quick Start

### Start Application:
```bash
cd /home/fvasquez/boughts_project
docker-compose up -d
```

### Stop Application:
```bash
docker-compose down
```

### Rebuild Containers:
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Access Application:
- **URL**: http://localhost:8081
- **Database**: Remotes @ 192.168.0.236:1433

## Artisan Commands

### Check Version:
```bash
docker exec boughts_project-php-1 bash -c "cd /var/www && php artisan --version"
```

### Clear Cache:
```bash
docker exec boughts_project-php-1 bash -c "cd /var/www && php artisan cache:clear"
```

### List Routes:
```bash
docker exec boughts_project-php-1 bash -c "cd /var/www && php artisan route:list"
```

### Create Database Backup:
```bash
docker exec boughts_project-php-1 bash -c "cd /var/www && php backup_database.php"
```

## Performance Optimizations

### Database:
- 11 high-impact indexes on SKUData, MarketPlaceMapping, BinStock, etc.
- Query optimization: 60-90% faster

### Application:
- Redis caching (80-90% faster than file cache)
- N+1 query fixes (99.5% faster bulk operations)
- Static data caching (categories, manufacturers)
- AJAX SKU search endpoints

### Result:
**10-20x overall performance improvement**

## Documentation

- **Upgrade History**: `UPGRADE_HISTORY.md`
- **Detailed Reports**: `/home/fvasquez/backups/`
  - `LARAVEL_8_UPGRADE_REPORT.md`
  - `FINAL_OPTIMIZATION_REPORT.md`

## Backup Locations

- **Project Files**: `/home/fvasquez/backups/boughts_project_*.tar.gz`
- **Database**: SQL Server backups in `/var/opt/mssql/data/` on database server

## Container Structure

```
boughts_project/
├── php           - PHP 8.1-FPM container
├── nginx         - Nginx web server
└── redis         - Redis 7 cache
```

## Important Files

- `Dockerfile` - PHP container definition
- `docker-compose.yml` - Service orchestration
- `boughts/.env` - Environment configuration
- `boughts/config/database.php` - Database configuration
- `boughts/backup_database.php` - Backup utility

## Troubleshooting

### Application not loading:
```bash
docker-compose logs php
docker-compose logs nginx
```

### Database connection issues:
```bash
docker exec boughts_project-php-1 bash -c "cd /var/www && php artisan config:clear && php artisan cache:clear"
```

### Redis not working:
```bash
docker exec boughts_project-redis-1 redis-cli ping
```

### Check PHP extensions:
```bash
docker exec boughts_project-php-1 php -m | grep -E '(sqlsrv|redis)'
```

## Maintenance

### Regular Tasks:
- Monitor application logs daily
- Create database backups weekly
- Update composer dependencies monthly
- Clear caches after configuration changes

### Cache Invalidation:
Clear cache when updating:
- Categories
- Manufacturers
- Part numbers
- Routes
- Configuration

## Security Notes

- Laravel 8 LTS ended January 2024 (consider upgrading to Laravel 10/11)
- PHP 8.1 active support until November 2025
- All passwords in `.env` file (never commit to git)
- Redis not exposed to public internet
- ODBC 18 with encryption enabled

## Future Upgrades

Recommended timeline:
1. **Q1-Q2 2026**: Upgrade to Laravel 10/11 LTS
2. **Q2 2026**: Upgrade to PHP 8.2 or 8.3
3. **2026**: Replace abandoned packages (flysystem-sftp, SwiftMailer)

---

**Last Updated**: December 6, 2025
**Port**: 8081
**Environment**: Production
