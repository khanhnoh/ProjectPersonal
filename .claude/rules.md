# Claude Development Rules - SAP Admin Hub

## 1. Module Architecture — Clean & Upgradeable

- **Không bao giờ overwrite core Laravel/Filament files** (`vendor/`, `bootstrap/`, framework internals).
- Mỗi module nằm trong **folder riêng biệt** theo cấu trúc:
  ```
  app/
  ├── Filament/Resources/{Module}/        ← Filament UI layer
  ├── Http/Controllers/{Module}/          ← Web/API controllers
  ├── Models/{Module}.php                 ← Eloquent model
  ├── Services/{Module}Service.php        ← Business logic
  └── Actions/{Module}/                   ← Single-purpose actions
  ```
- **Service layer** chứa business logic, controller chỉ gọi service — không viết logic trong controller.
- Khi upgrade Filament/Laravel: chỉ chạy `composer update`, không cần sửa code app.

## 2. TALL Stack cho Complex Pages

- **TALL = Tailwind + Alpine.js + Livewire + Laravel**
- Khi nào dùng TALL thay vì Filament thuần:
  - Page cần **real-time interaction** (live search, dynamic fields, drag-drop)
  - Page cần **custom layout** không fit Filament default
  - **Gantt chart**, **Kanban board**, **Dashboard widget phức tạp**
- Livewire component đặt ở `app/Livewire/{Module}/`
- Blade view đặt ở `resources/views/livewire/{module}/`
- Vẫn có thể **embed Livewire vào Filament page** thông qua custom page/widget

## 3. File Size — Tối đa 300 dòng

- **Mỗi file PHP không quá 300 dòng code** (không tính blank lines và comments).
- Nếu file vượt 300 dòng → tách ra:
  - Controller to nhiều → tách thành **Action classes** hoặc **Service methods**
  - Filament Resource to nhiều → tách **Form schema** và **Table schema** thành trait/class riêng:
    ```php
    // LeadResource/Schemas/LeadFormSchema.php
    // LeadResource/Schemas/LeadTableSchema.php
    ```
  - Model to nhiều → dùng **traits** cho từng nhóm method

## 4. TDD — Test trước, Code sau

- **Quy trình bắt buộc** khi phát triển feature mới:
  1. Viết **plan** (file `.claude/plans/*.md`) mô tả feature
  2. Viết **test** trước (unit + feature test)
  3. Chạy test → ❌ fail
  4. Viết code để test pass → ✅
  5. Refactor nếu cần

- Test files đặt ở:
  ```
  tests/
  ├── Unit/{Module}/          ← Unit tests (Model, Service, Action)
  └── Feature/{Module}/       ← Feature tests (HTTP, Filament)
  ```

- Chạy test:
  ```bash
  php artisan test                          # All tests
  php artisan test --filter=LeadTest        # Single module
  php artisan test tests/Feature/Leads/     # Single folder
  ```

## 5. Feature Comments — Mỗi Module có Header

- **Mỗi file PHP bắt đầu bằng docblock** mô tả module và feature:

  ```php
  <?php
  /**
   * Module: Lead & Scope Management (Module 1)
   * Feature: Lead creation, status tracking, scope linking
   * Related: Scope, BANTAssessment
   * Last updated: 2024-01-01
   */
  ```

- Khi thêm method phức tạp, comment ngắn **WHY** (không phải WHAT):
  ```php
  // Recalculate after scope changes because cost depends on total hours
  public function recalculate(): void { ... }
  ```

- **Không** comment self-evident code:
  ```php
  // BAD: Get the lead by ID
  $lead = Lead::find($id);

  // GOOD: (no comment needed)
  $lead = Lead::find($id);
  ```

---

## Quick Reference

| Rule | Limit |
|------|-------|
| Lines per file | ≤ 300 |
| Logic in Controller | ❌ (dùng Service) |
| Overwrite vendor/ | ❌ |
| Test before code | ✅ |
| Plan before feature | ✅ |
| TALL for complex UI | ✅ |
