# Setup SAP Admin Hub trên Laragon

## Yêu cầu
- **Laragon** đã cài đặt (www.laragon.org)
- **PHP 8.2+** và **MySQL 8.0** (tích hợp trong Laragon)
- **Composer** (tích hợp trong Laragon)

## Bước 1: Mở Laragon Terminal

1. Mở **Laragon**
2. Click **Terminal** (hoặc **Console**) → mở terminal có sẵn environment

```bash
# Kiểm tra versions
php -v
mysql --version
composer --version
```

## Bước 2: Tạo Laravel 12 Project

```bash
# Vào thư mục www của Laragon
cd C:\laragon\www

# Tạo project
composer create-project laravel/laravel sap-admin-hub

# Vào project
cd sap-admin-hub
```

## Bước 3: Cấu hình Database (.env)

Mở file `.env` (trong thư mục `sap-admin-hub`):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sap_admin_hub
DB_USERNAME=root
DB_PASSWORD=
```

> Laragon mặc định: root user, không password

## Bước 4: Tạo Database

Mở **Laragon → MySQL Console** (hoặc phpMyAdmin):

```sql
CREATE DATABASE sap_admin_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Hoặc dùng Artisan:

```bash
php artisan db:create  # Nếu có extension, hoặc
# Tạo manual qua phpMyAdmin/MySQL Console
```

## Bước 5: Generate Models & Migrations

Từ trong thư mục `sap-admin-hub`:

```bash
# Generate models with migrations
php artisan make:model Lead -m
php artisan make:model Scope -m
php artisan make:model BANTAssessment -m
php artisan make:model EffortEstimation -m
php artisan make:model CostEstimation -m
php artisan make:model Timeline -m
php artisan make:model ResourceAllocation -m
php artisan make:model Artifact -m
php artisan make:model PitchingChecklist -m

# Generate controllers (resource)
php artisan make:controller LeadController --model=Lead --resource
php artisan make:controller ScopeController --model=Scope --resource
php artisan make:controller BANTAssessmentController --model=BANTAssessment --resource
php artisan make:controller EffortEstimationController --model=EffortEstimation --resource
php artisan make:controller CostEstimationController --model=CostEstimation --resource
php artisan make:controller TimelineController --model=Timeline --resource
php artisan make:controller ResourceAllocationController --model=ResourceAllocation --resource
php artisan make:controller ArtifactController --model=Artifact --resource
php artisan make:controller PitchingChecklistController --model=PitchingChecklist --resource
```

## Bước 6: Chạy Migrations & Seed

```bash
# Run all migrations
php artisan migrate

# Seed database (nếu có)
php artisan db:seed
```

## Bước 7: Start Development Server

```bash
php artisan serve
```

Hoặc dùng Laragon:
1. Tạo **Virtual Host** trong Laragon cho project
2. Click **Start All**
3. Truy cập: `http://sap-admin-hub.local`

## Bước 8: Login

- **Email**: admin@example.com
- **Password**: password

---

## Troubleshooting

### ❌ `Composer command not found`
→ Dùng **Laragon Terminal** chứ không phải cmd/PowerShell thường

### ❌ `SQLSTATE[HY000]: General error: 1030`
→ Database chưa tạo, chạy:
```bash
CREATE DATABASE sap_admin_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### ❌ Migration fails
→ Check `DB_*` config trong `.env` và confirm MySQL running trong Laragon

---

## Next: Development

Sau khi setup xong, mình sẽ tạo:
- Database schema (migrations)
- Models & relationships
- Controllers & views
- Authentication
- Dashboard

Chi tiết xem `CLAUDE.md` & plan file.
