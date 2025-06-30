<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Hệ thống Khóa học</title>
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
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .input-field {
            font-family: 'Quicksand', sans-serif;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }
        .submit-button {
            font-family: 'Montserrat', sans-serif;
            background-color: #667eea;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            width: 100%;
        }
        .submit-button:hover {
            background-color: #5a67d8;
            transform: translateY(-2px);
        }
        .submit-button:active {
            transform: translateY(0);
        }
        h2 {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .error-message {
            color: #ef4444;
            margin-top: -10px;
            margin-bottom: 20px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-3xl">Đăng nhập</h2>
        <form action="check.php" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" class="input-field" required>
            <input type="password" name="password" placeholder="Mật khẩu" class="input-field" required>
            <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo '<p class="error-message">Tên đăng nhập hoặc mật khẩu không đúng.</p>';
                } else if (isset($_GET['error']) && $_GET['error'] == 2) {
                    echo '<p class="error-message">Bạn không có quyền truy cập khóa học này.</p>';
                }
            ?>
            <button type="submit" class="submit-button">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
