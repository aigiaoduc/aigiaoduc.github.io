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

// Kiểm tra quyền truy cập khóa học A
// Kiểm tra xem 'khoahocA' có trong mảng roles của người dùng không
if (!in_array('khoahocA', $user_roles) && !in_array('admin', $user_roles)) {
    header('Location: login.php?error=2'); // Lỗi không có quyền
    exit;
}

// Lấy tên khóa học từ config
$course_name = $courses['khoahocA']['name'] ?? 'Khóa học không xác định';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo truyện tranh bằng AI tự động - Hệ thống Khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@400;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        .header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #a7bfe8 0%, #6190e8 100%);
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
            <p class="text-xl mb-8">Khám phá cách tạo truyện tranh tự động bằng AI.</p>
            <a href="#content" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300">Bắt đầu học</a>
        </div>

        <section id="content" class="my-12">
            <h3 class="text-4xl font-bold text-center mb-10 text-gray-800">Nội dung Khóa học: Tạo truyện tranh bằng AI tự động</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-blue-700">Bài 1: Giới thiệu về AI</h4>
                    <p class="text-gray-700">Tìm hiểu các khái niệm cơ bản về Trí tuệ Nhân tạo và ứng dụng của nó.</p>
                    <a href="https://www.youtube.com/watch?v=L-aPLYx3bCw&t=2s" target="_blank" class="mt-6 inline-block bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Xem video</a>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-blue-700">Bài 2: Tạo mail ảo</h4>
                    <p class="text-gray-700">Hướng dẫn cách tạo và sử dụng email ảo để bảo vệ thông tin cá nhân.</p>
                    <a href="https://www.youtube.com/watch?v=NhFUIx7ydpE&t=32s" target="_blank" class="mt-6 inline-block bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Xem video</a>
                </div>
                <div class="card">
                    <h4 class="text-2xl font-bold mb-4 text-blue-700">Bài 3: Tạo truyện bằng AI</h4>
                    <p class="text-gray-700">Khám phá các công cụ và phương pháp để tạo ra những câu chuyện độc đáo bằng AI.</p>
                    <a href="https://www.youtube.com/watch?v=Sn-23tvcHrc" target="_blank" class="mt-6 inline-block bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Xem video</a>
                </div>
                <!-- Có thể thêm các bài học khác tại đây -->
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
