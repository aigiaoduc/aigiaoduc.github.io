<?php
session_start();
require_once 'config.php'; // Bao gồm file cấu hình để lấy danh sách khóa học

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$user_roles = $_SESSION['roles'] ?? []; // Lấy các vai trò của người dùng

// Lọc ra các khóa học mà người dùng có quyền truy cập
$accessible_courses = [];
foreach ($user_roles as $role) {
    if (isset($courses[$role])) {
        $accessible_courses[$role] = $courses[$role];
    }
}

// Nếu không có khóa học nào được truy cập, chuyển hướng về trang đăng nhập
if (empty($accessible_courses)) {
    header('Location: login.php?error=2'); // Lỗi không có quyền
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Khóa học - Hệ thống Khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@400;600;700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .container-select {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2.5rem;
        }
        .course-card {
            background-color: #f0f4f8;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .course-card h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2f73ff;
            margin-bottom: 10px;
        }
        .course-card a {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 10px;
        }
        .course-card a:hover {
            background-color: #5a67d8;
            transform: translateY(-2px);
        }
        .logout-button {
            background-color: #ef4444;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
            display: inline-block;
        }
        .logout-button:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-select">
        <h2 class="text-3xl">Chào mừng, <?php echo htmlspecialchars($username); ?>!</h2>
        <p class="text-lg mb-8 text-gray-600">Vui lòng chọn khóa học bạn muốn truy cập:</p>

        <?php if (!empty($accessible_courses)): ?>
            <?php foreach ($accessible_courses as $key => $course): ?>
                <div class="course-card">
                    <h3><?php echo htmlspecialchars($course['name']); ?></h3>
                    <a href="<?php echo htmlspecialchars($course['file']); ?>">Vào khóa học</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-red-500">Bạn không có quyền truy cập khóa học nào.</p>
        <?php endif; ?>

        <a href="logout.php" class="logout-button">Đăng xuất</a>
    </div>
</body>
</html>
