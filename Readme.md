# SAP Sales Hub

Ứng dụng React đơn file để **quản lý dự án & cơ hội bán hàng SAP**. Toàn bộ giao diện nằm trong `index.html`, chạy trực tiếp trên trình duyệt — **không cần `npm install` hay bước build**.

## Công nghệ

- **React 18** (UMD + Babel standalone — biên dịch JSX ngay trong trình duyệt)
- **Tailwind CSS** (CDN) — giao diện
- **Lucide Icons** (CDN) — bộ icon
- **LocalStorage** — lưu dữ liệu ngay trên máy người dùng

## Tính năng

- **Dashboard** thống kê nhanh: tổng số lead, số lead quy mô Lớn, số phân hệ SAP đang theo dõi.
- **Lead Management** — module đầu tiên, với các trường:
  - **Tên KH** — tên khách hàng
  - **Phân hệ SAP** — FI, CO, MM, SD, PP, HCM, WM, QM, S/4HANA
  - **Quy mô** — Nhỏ / Vừa / Lớn
- **Lưu tự động vào LocalStorage**: dữ liệu được giữ lại sau khi tải lại trang.
- **Export JSON**: tải toàn bộ danh sách lead ra file `.json`.
- Thêm / xóa lead, hiển thị dạng bảng có badge phân hệ & quy mô.

## Cách chạy

Mở trực tiếp file `index.html` bằng trình duyệt (double-click), hoặc chạy một web server tĩnh:

```bash
# Python
python -m http.server 8000
# rồi mở http://localhost:8000

# hoặc Node
npx serve .
```

> Cần kết nối Internet ở lần chạy đầu để tải React, Tailwind và Lucide từ CDN.

## Lưu trữ dữ liệu

Dữ liệu lead được lưu trong LocalStorage dưới khóa `sap-sales-hub:v1`. Xóa khóa này (qua DevTools) sẽ xóa toàn bộ dữ liệu trên máy.

## Hướng phát triển tiếp theo

- Thêm các module: Opportunity, Quotation, Project Tracking.
- Tìm kiếm / lọc / sắp xếp lead.
- Nhập (Import) JSON để khôi phục dữ liệu.
