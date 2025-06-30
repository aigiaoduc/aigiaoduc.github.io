<?php
session_start();
require_once 'config.php'; // Bao gồm file cấu hình để lấy danh sách khóa học

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$user_roles = $_SESSION['roles'] ?? [];

// Kiểm tra quyền truy cập khóa học B
// Kiểm tra xem 'khoahocB' có trong mảng roles của người dùng không
if (!in_array('khoahocB', $user_roles) && !in_array('admin', $user_roles)) {
    header('Location: login.php?error=2'); // Lỗi không có quyền
    exit;
}

// Lấy tên khóa học từ config
$course_name = $courses['khoahocB']['name'] ?? 'Khóa học không xác định';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học B - Hệ thống Khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@400;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        .header {
            background: linear-gradient(90deg, #4CAF50 0%, #8BC34A 100%); /* Màu xanh lá cây */
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #c8e6c9 0%, #81c784 100%); /* Màu xanh lá cây nhạt */
            color: white;
            padding: 6rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            margin-top: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: moveCircle1 10s infinite alternate;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: moveCircle2 12s infinite alternate;
        }
        @keyframes moveCircle1 {
            0% { transform: translate(0, 0); }
            100% { transform: translate(100px, 50px); }
        }
        @keyframes moveCircle2 {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-80px, -30px); }
        }
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Quicksand', sans-serif;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }
        .logout-button {
            background-color: #ef4444;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .logout-button:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }
        h1, h2, h3 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        p {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container flex justify-between items-center">
            <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($course_name); ?></h1>
            <nav>
                <a href="logout.php" class="logout-button">Đăng xuất</a>
            </nav>
        </div>
    </header>

    <main class="container my-8">
        <div class="hero-section">
            <h2 class="text-5xl font-bold mb-4">Chào mừng, <?php echo htmlspecialchars($username); ?>!</h2>
            <p class="text-xl mb-8">Khám phá những kiến thức chuyên sâu trong Khóa học B.</p>
            <a href="#content" class="inline-block bg-white text-green-600 px-8 py-3 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300">Bắt đầu học</a>
        </div>

        <section id="content" class="my-12">
            <h3 class="text-4xl font-bold text-center mb-10 text-gray-800">Nội dung Khóa học B</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 1: Phát triển Web với PHP</h4>
                    <p class="text-gray-700">Tìm hiểu các nguyên tắc cơ bản của phát triển web động sử dụng PHP và MySQL.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 2: Cơ sở dữ liệu và SQL</h4>
                    <p class="text-gray-700">Nắm vững cách thiết kế, quản lý và truy vấn cơ sở dữ liệu với SQL.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 3: Framework Laravel</h4>
                    <p class="text-gray-700">Khám phá Laravel, một framework PHP mạnh mẽ để xây dựng ứng dụng web hiện đại.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 4: API RESTful</h4>
                    <p class="text-gray-700">Học cách thiết kế và triển khai các API RESTful cho ứng dụng của bạn.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 5: Bảo mật Web</h4>
                    <p class="text-gray-700">Tìm hiểu các lỗ hổng bảo mật phổ biến và cách bảo vệ ứng dụng web của bạn.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-green-700">Bài 6: Triển khai và DevOps</h4>
                    <p class="text-gray-700">Nắm vững quy trình triển khai ứng dụng web và các khái niệm cơ bản về DevOps.</p>
                    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition duration-300">Xem chi tiết</button>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container text-center">
            <p>&copy; 2025 Hệ thống Khóa học. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
</body>
</html>
