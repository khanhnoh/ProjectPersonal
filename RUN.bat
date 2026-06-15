@echo off
chcp 65001 >nul
cls
echo ========================================
echo   SAP Admin Hub - Auto Setup
echo ========================================
echo.

cd /d "D:\Claude for work\Project personal"

echo [1/6] Installing composer dependencies...
call composer install
if errorlevel 1 (
    echo ERROR: Composer install failed
    pause
    exit /b 1
)
echo ✓ Composer install success
echo.

echo [2/6] Generating app key...
call php artisan key:generate
if errorlevel 1 (
    echo ERROR: Key generation failed
    pause
    exit /b 1
)
echo ✓ App key generated
echo.

echo [3/6] Creating database tables (migration)...
call php artisan migrate --force
if errorlevel 1 (
    echo ERROR: Migration failed
    pause
    exit /b 1
)
echo ✓ Database tables created
echo.

echo [4/6] Seeding default user...
call php artisan db:seed
if errorlevel 1 (
    echo WARNING: Seed failed (may already exist)
)
echo ✓ Seed completed
echo.

echo [5/6] Optimizing cache...
call php artisan optimize
echo ✓ Cache optimized
echo.

echo ========================================
echo   ✓ Setup Complete!
echo ========================================
echo.
echo [6/6] Starting Laravel development server...
echo.
echo URL: http://localhost:8000
echo Email: admin@example.com
echo Password: password
echo.
echo Press Ctrl+C to stop the server
echo.

call php artisan serve
