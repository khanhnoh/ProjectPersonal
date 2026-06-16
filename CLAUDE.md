# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

**SAP Sales Hub** — Laravel 12 admin web application cho quản lý dự án & cơ hội bán hàng SAP.

**Tech Stack (TALL):**
- **T**ailwind CSS — styling
- **A**lpine.js — lightweight JS interactions
- **L**ivewire 3 — reactive components
- **L**aravel 12 + **Filament v4** — framework + admin UI

**Environment:** Laragon (PHP 8.3, MySQL 8.0, Composer)
**URL khi dev:** `http://localhost:8000/admin`
**Login:** `admin@example.com` / `password`

---

## Running the App

```bash
# Double-click START.bat
# hoặc chạy thủ công:
cd "D:\Claude for work\Project personal"
php artisan serve
```

---

## Development Rules

> Chi tiết đầy đủ ở `.claude/rules.md`

### Rule 1 — Module Architecture (Clean & Upgradeable)

**Không bao giờ overwrite `vendor/`, `bootstrap/cache/`, framework internals.**

Mỗi module tổ chức theo cấu trúc:
```
app/
├── Filament/Resources/{Module}/        ← Filament UI (Resource, Pages, Widgets)
│   ├── Schemas/                        ← Tách Form & Table schema nếu > 300 dòng
├── Http/Controllers/{Module}/          ← Thin controllers, chỉ gọi Service
├── Livewire/{Module}/                  ← Livewire components cho complex pages
├── Models/                             ← Eloquent models
├── Services/{Module}Service.php        ← Business logic
└── Actions/{Module}/                   ← Single-purpose action classes

resources/views/
├── livewire/{module}/                  ← Blade views cho Livewire components
└── filament/{module}/                  ← Custom Filament view overrides (nếu cần)

tests/
├── Unit/{Module}/                      ← Unit tests
└── Feature/{Module}/                   ← Feature/HTTP tests
```

### Rule 2 — TALL Stack cho Complex Pages

Dùng **Livewire + Alpine.js** khi:
- Page cần real-time (live search, dynamic fields, counter)
- Layout không fit Filament default (Gantt chart, Kanban)
- Custom dashboard widgets

Livewire components có thể **embed vào Filament** qua `@livewire()` hoặc custom Filament Page.

### Rule 3 — File Size ≤ 300 dòng

- Nếu file vượt 300 dòng → tách nhỏ:
  - Controller → Action classes hoặc Service methods
  - Filament Resource → tách `FormSchema` và `TableSchema` thành trait riêng
  - Model → dùng traits cho từng nhóm method

### Rule 4 — TDD: Plan → Test → Code

**Bắt buộc với mọi feature mới:**

```
1. Viết plan  →  .claude/plans/{feature}.md
2. Viết test  →  tests/Unit hoặc tests/Feature
3. Chạy test  →  ❌ fail (expected)
4. Viết code  →  ✅ pass
5. Refactor   →  tests vẫn pass
```

```bash
php artisan test                         # Chạy tất cả tests
php artisan test --filter=LeadTest       # Chạy test một module
php artisan test tests/Feature/Leads/    # Chạy test một folder
```

### Rule 5 — Feature Comments

Mỗi file PHP bắt đầu bằng docblock:

```php
<?php
/**
 * Module: Lead & Scope Management (Module 1)
 * Feature: Lead creation, status tracking, scope linking
 * Related: Scope, BANTAssessment
 */
```

Comment chỉ cho WHY (không phải WHAT). Không comment code self-evident.

---

## Code Architecture

### Filament Admin Panel

- **Route:** `/admin`
- **Provider:** `app/Providers/Filament/AdminPanelProvider.php`
- **Resources:** `app/Filament/Resources/`
- **Theme:** Blue (Color::Blue)

Filament auto-discovers resources trong `app/Filament/Resources/` — chỉ cần tạo file, không cần register.

### 5 Business Modules

| # | Module | Models | Filament Resource |
|---|--------|--------|-------------------|
| 1 | Lead & Scope Management | `Lead`, `Scope` | `LeadResource`, `ScopeResource` |
| 2 | BANT Qualification | `BANTAssessment` | `BANTAssessmentResource` |
| 3 | Effort & Cost Estimation | `EffortEstimation`, `CostEstimation` | `EffortEstimationResource`, `CostEstimationResource` |
| 4 | Timeline & Resources | `Timeline`, `ResourceAllocation` | `TimelineResource`, `ResourceAllocationResource` |
| 5 | Artifacts & Pitching | `Artifact`, `PitchingChecklist` | `ArtifactResource`, `PitchingChecklistResource` |

### Model Relationships

```
Lead ──< Scope ──< EffortEstimation
    \       ├──< CostEstimation (1 per scope)
     \      ├──< Timeline ──< ResourceAllocation
      \     ├──< Artifact
      └─── └──< PitchingChecklist
Lead ──< BANTAssessment (1 per lead)
```

### Key Artisan Commands

```bash
# Filament
php artisan make:filament-resource {Model} --generate  # Tạo resource với form & table
php artisan make:filament-page {Name}                  # Tạo custom page
php artisan make:filament-widget {Name}                # Tạo widget
php artisan filament:upgrade                           # Upgrade Filament assets

# Livewire
php artisan make:livewire {Module}/{ComponentName}     # Tạo Livewire component

# Laravel
php artisan make:model {Name} -m                       # Model + migration
php artisan make:service {Name}Service                 # Service class (manual)
php artisan migrate                                    # Chạy migrations
php artisan migrate:fresh --seed                       # Reset DB + seed

# Testing
php artisan test
php artisan test --filter={TestClass}
php artisan test --coverage                            # Coverage report
```

### Database

- **Connection:** MySQL, DB name `sap_admin_hub`
- **Migrations:** `database/migrations/` — sorted by timestamp
- **Seeder:** `database/seeders/DatabaseSeeder.php` — seeds default admin user
- **Inspect (DevTools):** Laragon → MySQL → phpMyAdmin

---

## Upgrade Guide

### Upgrade Filament

```bash
composer update filament/filament
php artisan filament:upgrade
```

### Upgrade Laravel

```bash
composer update laravel/framework
php artisan migrate
```

Vì không overwrite vendor/ hay core files, upgrade chỉ cần 2 lệnh trên.

---

## File Structure Quick Reference

```
D:\Claude for work\Project personal\
├── app/
│   ├── Filament/Resources/     ← 9 Filament resources (auto-discovered)
│   ├── Http/Controllers/       ← Thin controllers
│   ├── Livewire/               ← Complex UI components (TALL)
│   ├── Models/                 ← Eloquent models với relationships
│   ├── Providers/Filament/     ← AdminPanelProvider
│   └── Services/               ← Business logic layer
├── database/
│   ├── migrations/             ← 10 migration files
│   └── seeders/
├── resources/views/
│   ├── auth/login.blade.php
│   ├── livewire/               ← Livewire Blade views
│   └── layouts/app.blade.php
├── routes/
│   ├── web.php                 ← Web routes (auth-protected)
│   └── auth.php                ← Login/logout routes
├── tests/
│   ├── Unit/                   ← Unit tests per module
│   └── Feature/                ← Feature tests per module
├── .claude/
│   ├── rules.md                ← Development rules (chi tiết)
│   └── settings.local.json     ← Claude permissions
├── START.bat                   ← One-click server start
├── artisan                     ← Laravel CLI
└── CLAUDE.md                   ← This file
```
