# Hệ thống quản lý quán photocopy
## Hướng dẫn cài đặt
**Cài đặt thư viện**
* Kích chuột phải vào Project, chọn Git Bash và chạy lệnh để cài đặt Laravel 
	> composer install

    > npm install


* Tạo file env, chạy lệnh để tạo database và config database
    > cp .env.example .env

* Tạo key
    > php artisan key: generate

* Tạo ra các bảng và dữ liệu mẫu cho database
    > php artisan migrate

    > php artisan db:seed
    
* Chạy ứng dụng
    > php artisan serve
* Login với tài khoản Quản trị viên
    > Tài khoản: danlv99nd@gmail.com

    > Mật khẩu: anhdannd99


