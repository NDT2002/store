#Bước 1: Tạo dự án mới:
-Tạo dự án mới bằng cách chạy câu lệnh: composer create-project laravel/laravel  Ten_database
bằng gitbash hoặc cmd trong thư mục (thông thường) htdocs 
#Bước 2: Chỉnh liên kết tới database
-Mở thư mục vừa tạo với visual studio code
-Tìm file .env trong thư mục root(gốc) của dự án vừa tạo
-Tìm đến đoạn và chỉnh DB_DATABASE
    DB_CONNECTION=mysql <!-- chọn loại ngôn cơ sở dữ liệu (bình thường không chỉnh) -->
    DB_HOST=127.0.0.1 <!-- chỉnh cổng truy cập web (bình thường không chỉnh) -->
    DB_PORT=3306<!-- chỉnh cổng truy cập database (phải trùng với cổng đang chạy trên xampp) -->
    DB_DATABASE=Ten_database <!-- chỉnh thành tên database của dự án -->
    DB_USERNAME=root <!-- chỉnh tên đăng nhập để truy cập database -->
    DB_PASSWORD= <!-- chỉnh mật khẩu để truy cập database -->
#Bước 3: tạo bảng mới trong cơ sở dữ liệu thông qua migration với cmd bằng gitbash
<!-- Migration trong Laravel là cách thức để quản lý cơ sở dữ liệu của ứng dụng bằng cách sử dụng mã để định nghĩa và quản lý cấu trúc của các bảng trong cơ sở dữ liệu.

Các migration được sử dụng để tạo bảng, sửa đổi cấu trúc của bảng, hoặc xóa bảng trong cơ sở dữ liệu. Thay vì phải thực hiện các thay đổi cơ sở dữ liệu thủ công, các migration giúp cho quá trình quản lý cơ sở dữ liệu trở nên dễ dàng hơn, đảm bảo tính nhất quán và giúp cho các nhà phát triển làm việc cùng nhau trên cùng một mã nguồn. -->
-Mở thư mục dự án vừa tạo bằng File Explorer chạy cmd với câu lệnh:
php artisan make:migration create_tenTable_table
-Sau đó mở file_create_students_table.php trong thư mục database\migrations\ và chỉnh sửa lại
<!-- Hàm up() trong Laravel Migration là một phương thức được sử dụng để tạo hoặc sửa đổi cấu trúc của bảng trong cơ sở dữ liệu. Để thực hiện các thay đổi đó, bạn có thể sử dụng các hàm của class Schema như create, table, drop, rename và addColumn. -->
-Ví dụ, đoạn mã sau đây sử dụng hàm create để tạo một bảng students trong cơ sở dữ liệu:
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('age');
        $table->string('address')->nullable();
        $table->timestamps();
    });
}
-Trong đoạn mã này, Schema::create('students', function (Blueprint $table)) sẽ tạo ra một bảng có tên là students. Sau đó, chúng ta định nghĩa các cột bao gồm id là cột chính, name là tên học sinh, age là tuổi, address là địa chỉ và timestamps sử dụng để lưu trữ thời gian tạo và cập nhật bản ghi.
-Hàm down() được sử dụng để hoàn tác các thay đổi cơ sở dữ liệu được định nghĩa trong hàm up(). Hàm này sẽ được gọi khi chạy lệnh php artisan migrate:rollback hoặc php artisan migrate:reset. Hàm down() thường được sử dụng để xóa các bảng hoặc cột được tạo ra trong hàm up().
#Bước :
#Bước :
#Bước :
#Bước :
#Bước :
#Bước :
#Bước :
#Bước :