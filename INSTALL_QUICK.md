# ⚡ Quick Install Guide - SAP Admin Hub

Hướng dẫn cài đặt **SAP Admin Hub** trên Laragon - chỉ **5 phút**!

## 📋 Yêu Cầu

- ✅ **Laragon** đã cài (www.laragon.org)
- ✅ PHP 8.2+ & MySQL 8.0 (tích hợp sẵn)
- ✅ Composer (tích hợp sẵn)

---

## 🚀 Cài Đặt (5 Bước)

### **Bước 1: Mở Laragon Terminal**

1. Mở **Laragon**
2. Click **Terminal** → Command Prompt/PowerShell sẽ mở

### **Bước 2: Tạo Laravel Project**

Dán lệnh này vào terminal:

```bash
cd C:\laragon\www
composer create-project laravel/laravel sap-admin-hub --prefer-dist
cd sap-admin-hub
```

⏱️ **Chờ ~3-5 phút** cho composer install xong

### **Bước 3: Copy Files Vào Project**

Tôi đã tạo sẵn tất cả các file (models, migrations, controllers, views). Copy vào project:

**Từ folder này (`laravel-sap-admin-hub/`):**
- Copy toàn bộ `app/` → `C:\laragon\www\sap-admin-hub\app\`
- Copy toàn bộ `database/` → `C:\laragon\www\sap-admin-hub\database\`
- Copy toàn bộ `resources/views/` → `C:\laragon\www\sap-admin-hub\resources\views\`
- Copy `routes/web.php` → `C:\laragon\www\sap-admin-hub\routes\`
- Copy `.env.example` → `C:\laragon\www\sap-admin-hub\.env`

> Hoặc dùng file explorer để drag-drop files

### **Bước 4: Setup Database & Environment**

Mở file `.env` (trong `sap-admin-hub` folder) và sửa:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sap_admin_hub
DB_USERNAME=root
DB_PASSWORD=
```

> **Laragon mặc định:** root user, password trống

Sau đó, chạy trong terminal (vẫn ở folder `sap-admin-hub`):

```bash
# Tạo app key
php artisan key:generate

# Chạy migrations (tạo bảng)
php artisan migrate

# Seed default user
php artisan db:seed
```

### **Bước 5: Start Server**

```bash
php artisan serve
```

Bạn sẽ thấy:
```
Laravel development server started on [http://127.0.0.1:8000]
```

---

## 🎯 Login & Sử Dụng

**URL:** http://localhost:8000

**Tài khoản mặc định:**
- Email: `admin@example.com`
- Password: `password`

---

## 📊 Modules Sẵn Có

Sau khi login, bạn sẽ thấy sidebar với:

1. **📊 Dashboard** - Tổng quan statistics
2. **👤 Leads** - Quản lý khách hàng
3. **📋 Scopes** - Phạm vi dự án
4. **🎯 BANT Assessment** - Đánh giá dự án (Budget, Authority, Need, Timeline)
5. **⏱️ Effort Estimation** - Dự toán công suất
6. **💰 Cost Estimation** - Tính giá vốn
7. **📅 Timelines** - Quản lý tiến độ
8. **👥 Resource Allocation** - Phân bổ nhân sự
9. **📄 Artifacts** - Tài liệu (upload file)
10. **✅ Pitching Checklist** - Checklist thuyết trình

---

## ⚙️ Troubleshooting

### ❌ `composer: command not found`
→ Sử dụng **Laragon Terminal** chứ không phải cmd/PowerShell thường

### ❌ `SQLSTATE[HY000]: General error: 1030`
→ Database chưa tạo. Tạo manual qua phpMyAdmin:

1. Mở Laragon → Click **MySQL** → phpMyAdmin
2. New Database: tên `sap_admin_hub`
3. Collation: `utf8mb4_unicode_ci`

### ❌ Migration fails
→ Kiểm tra `.env` - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` đúng chưa?

### ❌ Page trắng hoặc error
1. Chạy `php artisan cache:clear`
2. Chạy `php artisan config:cache`
3. Refresh browser

---

## 📝 Các File Đã Tạo

```
app/
├── Models/
│   ├── Lead.php
│   ├── Scope.php
│   ├── BANTAssessment.php
│   ├── EffortEstimation.php
│   ├── CostEstimation.php
│   ├── Timeline.php
│   ├── ResourceAllocation.php
│   ├── Artifact.php
│   └── PitchingChecklist.php
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── LeadController.php
│   ├── ScopeController.php
│   ├── BANTAssessmentController.php
│   ├── EffortEstimationController.php
│   ├── CostEstimationController.php
│   ├── TimelineController.php
│   ├── ResourceAllocationController.php
│   ├── ArtifactController.php
│   └── PitchingChecklistController.php

database/
├── migrations/
│   ├── 2024_01_01_create_users_table.php
│   ├── 2024_01_02_create_leads_table.php
│   ├── 2024_01_03_create_scopes_table.php
│   ├── 2024_01_04_create_bant_assessments_table.php
│   ├── 2024_01_05_create_effort_estimations_table.php
│   ├── 2024_01_06_create_cost_estimations_table.php
│   ├── 2024_01_07_create_timelines_table.php
│   ├── 2024_01_08_create_resource_allocations_table.php
│   ├── 2024_01_09_create_artifacts_table.php
│   └── 2024_01_10_create_pitching_checklists_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/app.blade.php
├── dashboard/index.blade.php
├── leads/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── scopes/ ...
├── bant-assessments/ ...
├── effort-estimations/ ...
├── cost-estimations/ ...
├── timelines/ ...
├── resource-allocations/ ...
├── artifacts/ ...
└── pitching-checklists/ ...
```

---

## 📌 Lưu Ý

- **Storage**: File upload lưu tại `storage/app/artifacts/`
- **Database**: Dữ liệu lưu ở MySQL (Laragon quản lý)
- **Tailwind**: CSS được load từ CDN, không cần compile
- **Auth**: Mặc định sử dụng Laravel default auth (session-based)

---

## 🎓 Tiếp Theo

Sau khi chạy được, bạn có thể:
- ✅ Tạo/edit/delete leads
- ✅ Quản lý scopes, assessments, costing
- ✅ Track timelines & resources
- ✅ Upload artifacts, quản lý checklist
- ✅ Xem dashboard statistics

**Cần tùy chỉnh gì thêm? Hãy edit:**
- Blade templates ở `resources/views/`
- Controllers logic ở `app/Http/Controllers/`
- Database schema (migrations) ở `database/migrations/`

---

**Chúc bạn cài đặt thành công! 🎉**

Nếu gặp vấn đề, check `SETUP_LARAGON.md` hoặc `CLAUDE.md` để hiểu cấu trúc.
