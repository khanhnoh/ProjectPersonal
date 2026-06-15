# 🚀 Chạy Project SAP Admin Hub - Hướng Dẫn Chi Tiết

Tôi đã tạo xong `composer.json` và Laravel structure. **Bây giờ bạn chỉ cần chạy 5 lệnh dưới đây!**

---

## 📋 Chạy Từ Laragon Terminal

**Mở Laragon → Click Terminal**

### **Lệnh 1: Vào folder project**

```bash
cd "D:\Claude for work\Project personal"
```

Nhấn **Enter**

### **Lệnh 2: Cài dependencies (Composer Install)**

```bash
composer install
```

⏱️ **Chờ 2-3 phút** (sẽ thấy output: `Loading composer repositories with package information...`)

Khi xong sẽ thấy: `✓ 94 packages installed`

### **Lệnh 3: Setup environment & app key**

```bash
copy .env.example .env
```

```bash
php artisan key:generate
```

Sẽ thấy: `Application key set successfully`

### **Lệnh 4: Tạo Database + Tables (Migration)**

```bash
php artisan migrate
```

Sẽ thấy:
```
Migrating: 2024_01_01_000000_create_users_table
Migrated:  2024_01_01_000000_create_users_table
...
Migration table created successfully.
✓ Migrated successfully
```

### **Lệnh 5: Seed Default User**

```bash
php artisan db:seed
```

Sẽ thấy: `Database seeded successfully`

---

## ✅ Chạy Server

```bash
php artisan serve
```

Sẽ thấy:
```
Laravel development server started on [http://127.0.0.1:8000]
```

---

## 🎯 Login & Sử Dụng

**Mở browser:** http://localhost:8000

**Tài khoản:**
- Email: `admin@example.com`
- Password: `password`

Sau đó bạn sẽ thấy **Dashboard** với 10 modules:
- 📊 Dashboard
- 👤 Leads
- 📋 Scopes
- 🎯 BANT Assessment
- ⏱️ Effort Estimation
- 💰 Cost Estimation
- 📅 Timelines
- 👥 Resource Allocation
- 📄 Artifacts
- ✅ Pitching Checklist

---

## ⚠️ Lưu Ý

- **Database:** Dùng MySQL (Laragon)
- **Default config:** root user, password trống (xem `.env`)
- **Storage:** Files upload vào `storage/app/artifacts/`
- **Stop server:** Ấn **Ctrl + C** trong terminal

---

## ❌ Gặp Lỗi?

### ❌ `composer: command not found`
→ Dùng **Laragon Terminal** chứ không phải cmd/PowerShell

### ❌ `SQLSTATE [HY000]: General error: 1030`
→ Database `sap_admin_hub` chưa tạo. Tạo manual qua phpMyAdmin:
1. Mở Laragon → MySQL → phpMyAdmin
2. New Database: `sap_admin_hub`
3. Collation: `utf8mb4_unicode_ci`

### ❌ `Call to undefined function Illuminate\...`
→ Chạy lại `composer install`

### ❌ Page trắng / 500 error
→ Chạy:
```bash
php artisan cache:clear
php artisan config:cache
```

---

**Done! 🎉 Bạn đã có Laravel admin app hoàn chỉnh!**

Nếu cần giúp gì thêm, hãy báo cho tôi biết! 👍
