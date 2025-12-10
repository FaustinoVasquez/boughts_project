# Boughts Project - Database Backup Instructions

**Date**: December 6, 2025
**Database Server**: 192.168.0.236
**Database Name**: Remotes

---

## SQL Server Backup Command

Run this on SQL Server 192.168.0.236:

```sql
USE master;
GO

BACKUP DATABASE [Remotes]
TO DISK = N'C:\SQLBackups\Remotes_PRE_LARAVEL11_UPGRADE_20251206.bak'
WITH FORMAT,
     NAME = 'Remotes - Pre Laravel 11 Upgrade',
     DESCRIPTION = 'Full backup before boughts_project Laravel 8 to 11 upgrade',
     COMPRESSION,
     STATS = 10;
GO
```

---

## Verify Backup

```sql
RESTORE VERIFYONLY
FROM DISK = N'C:\SQLBackups\Remotes_PRE_LARAVEL11_UPGRADE_20251206.bak';
GO
```

---

## Alternative: Backup via PHP Container

If you have sufficient permissions from the application:

```bash
docker exec boughts_project-php-1 php -r "
\$conn = new PDO('sqlsrv:Server=192.168.0.236,1433;Database=Remotes;TrustServerCertificate=true', 'tempuser', 'pLa13t1B');
\$sql = \"BACKUP DATABASE [Remotes] TO DISK = N'C:\\\\SQLBackups\\\\Remotes_PRE_LARAVEL11_UPGRADE_20251206.bak' WITH FORMAT, COMPRESSION\";
\$conn->exec(\$sql);
echo 'Backup completed successfully';
"
```

---

## Backup Status

- [ ] Database backup created
- [ ] Backup verified
- [ ] Backup location documented

**Note**: Ensure backup is created before proceeding with Laravel upgrade.
