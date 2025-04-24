# Eshop Electronics - Laravel Project

Đây là source code của một website thương mại điện tử bán thiết bị điện tử, được xây dựng bằng Laravel.

---

## Yêu cầu môi trường
- PHP >= 8.2
- Composer
- MySQL >= 5.7 / MariaDB >= 10.3

## Hướng dẫn cài đặt

### 1. Clone source và checkout đúng nhánh

> **Lưu ý:** Dự án nằm ở nhánh `laravel-project`, bạn cần checkout nhánh này sau khi clone.

**Các bước thực hiện:**

1. Mở Git Bash.
2. Clone repository về máy tính:
    ```bash
    git clone https://github.com/dvanhoang100904/eshop_electronics.git
    ```
3. Di chuyển vào thư mục dự án:
    ```bash
    cd eshop_electronics
    ```
4. Checkout vào nhánh `laravel-project`:
    ```bash
    git checkout laravel-project
    ```

### 2. Cấu hình môi trường `.env`

1. Cài đặt tất cả dependencies của Laravel:
    ```bash
    composer install
    ```
2. Sao chép file `.env.example` thành `.env`:
    ```bash
    cp .env.example .env
    ```
3. Tạo key cho ứng dụng Laravel:
    ```bash
    php artisan key:generate
    ```

### 3. Tạo storage link (nếu có hình ảnh)

1. Tạo storage link:
    ```bash
    php artisan storage:link
    ```

2. Tạo các thư mục chứa hình ảnh nếu chưa có:

    Products
    ```bash
    mkdir -p public/storage/products
    ```
    Categories
    ```bash
    mkdir -p public/storage/categories
    ```
    Slides
    ```bash
    mkdir -p public/storage/slides
    ```
    

### 4. Các câu lệnh để tạo bảng và xóa bảng và tạo dữ liệu mẫu

1. Chạy lệnh migrate để tạo bảng và seed dữ liệu mẫu:
   
   Tạo bảng:
    ```bash
    php artisan migrate
    ```
    
   Xóa bảng:
   ```bash
    php artisan migrate:rollback
    ```
   Hoặc
   ```bash
    php artisan migrate:reset
    ```
    
   Tạo dữ liệu mẫu:
    ```bash
    php artisan db:seed
    ```

   Xóa bảng + tạo bảng:
    ```bash
    php artisan migrate:refresh
    ```
    
   Xóa bảng + tạo bảng + tạo dữ liệu mẫu
    ```bash
    php artisan migrate:refresh --seed
    ```

### 5. Chạy ứng dụng

1. Chạy ứng dụng Laravel:
    ```bash
    php artisan serve
    ```
    
Sau khi thực hiện tất cả các bước trên, bạn có thể truy cập ứng dụng tại địa chỉ [http://localhost:8000](http://localhost:8000).

### 🧪 Tài khoản đăng nhập thử nghiệm admin

http://127.0.0.1:8000/admin/login

**Admin**
- Email: admin@gmail.com
- Mật khẩu: 123456

---

##  Cấu trúc thư mục chính

- `app/` - Code backend chính của ứng dụng Laravel
  - `app/Models/` - Các model đại diện cho bảng trong cơ sở dữ liệu
  - `app/Http/Controllers/` - Các controller xử lý request và trả về response
  - `app/Http/Middleware/` - Các middleware xử lý logic trước/sau khi request được xử lý
  - `app/Http/Requests/` - Các form request dùng để validate dữ liệu đầu vào một cách rõ ràng và tách biệt
- `database/migrations/` - Các file migration định nghĩa cấu trúc bảng cơ sở dữ liệu
- `database/seeders/` - Các file seed để thêm dữ liệu mẫu vào database
- `resources/views/` - Giao diện frontend viết bằng Blade template
- `routes/web.php` - Định nghĩa các route cho ứng dụng web

---

## Liên hệ

- Tác giả: [Đào Văn Hoàng](https://github.com/dvanhoang100904)
