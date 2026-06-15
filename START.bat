@echo off
title SAP Admin Hub
color 0A

set PHP=C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe
set PROJECT=D:\Claude for work\Project personal

cls
echo.
echo  =========================================
echo    SAP Admin Hub - Starting...
echo  =========================================
echo.

cd /d "%PROJECT%"

echo  [*] Starting Laravel server...
echo.
echo  =========================================
echo    URL    : http://localhost:8000
echo    Email  : admin@example.com
echo    Password: password
echo  =========================================
echo.
echo  Press Ctrl+C to stop the server
echo.

start "" http://localhost:8000

"%PHP%" artisan serve --host=127.0.0.1 --port=8000
