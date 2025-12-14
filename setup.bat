@echo off
REM Setup script untuk fix Laravel loading lambat (Windows)

echo ========================================
echo Setting up Laravel project...
echo ========================================
echo.

REM 1. Create empty database.sqlite file
echo [1/2] Creating database.sqlite file...
type nul > database\database.sqlite
echo       Done!
echo.

REM 2. Clear Laravel caches
echo [2/2] Clearing Laravel caches...
call php artisan config:clear
call php artisan cache:clear
call php artisan route:clear
call php artisan view:clear
echo       Done!
echo.

echo ========================================
echo Setup complete!
echo ========================================
echo.
echo Next steps:
echo 1. Make sure Express.js is running on port 3000
echo 2. Check .env file has: EXPRESS_API_URL=http://127.0.0.1:3000
echo 3. Run: php artisan serve
echo.
pause
