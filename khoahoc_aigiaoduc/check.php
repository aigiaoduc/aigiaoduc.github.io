<?php
session_start();

// Bao gồm file cấu hình tài khoản
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['roles'] = $users[$username]['roles']; // Lưu mảng các vai trò

        // Chuyển hướng dựa trên số lượng khóa học được phân quyền
        if (count($_SESSION['roles']) > 1) {
            header('Location: select_course.php');
            exit;
        } elseif (count($_SESSION['roles']) === 1) {
            // Nếu chỉ có một khóa học, chuyển hướng trực tiếp đến khóa học đó
            $single_role = $_SESSION['roles'][0];
            if (isset($courses[$single_role])) {
                header('Location: ' . $courses[$single_role]['file']);
                exit;
            } else {
                // Trường hợp không tìm thấy file khóa học, chuyển về login
                header('Location: login.php?error=2');
                exit;
            }
        } else {
            // Không có quyền truy cập khóa học nào
            header('Location: login.php?error=2');
            exit;
        }
    } else {
        // Sai tên đăng nhập hoặc mật khẩu
        header('Location: login.php?error=1');
        exit;
    }
} else {
    // Nếu truy cập trực tiếp check.php mà không qua form POST
    header('Location: login.php');
    exit;
}
?>
