<?php
// Danh sách tài khoản và quyền truy cập
// Bạn có thể thêm, sửa, xóa tài khoản tại đây.
// Định dạng: 'username' => ['password' => 'mật khẩu', 'role' => 'quyền_truy_cập']
// Quyền truy cập có thể là 'khoahocA', 'khoahocB', hoặc 'admin'
$users = [
    'hocvienA' => ['password' => '123', 'roles' => ['khoahocA']],
    'hocvienB' => ['password' => '456', 'roles' => ['khoahocB']],
    'admin' => ['password' => '0355213107', 'roles' => ['khoahocA', 'khoahocB', 'khoahoc_ungdung_ai_truyentranh']], // Admin có quyền truy cập tất cả các khóa học
    // Thêm tài khoản mới tại đây:
    // 'ten_tai_khoan_moi' => ['password' => 'mat_khau_moi', 'roles' => ['ten_khoa_hoc_1', 'ten_khoa_hoc_2']], // Có thể là một mảng các quyền
];

// Định nghĩa các khóa học và đường dẫn tương ứng
$courses = [
    'khoahocA' => [
        'name' => 'Tạo truyện tranh bằng AI tự động',
        'file' => 'khoahocA.php'
    ],
    'khoahocB' => [
        'name' => 'Phát triển Web với PHP',
        'file' => 'khoahocB.php'
    ],
    'khoahoc_ungdung_ai_truyentranh' => [
        'name' => 'Ứng Dụng AI Tạo Truyện Tranh Minh Họa Nội Dung',
        'file' => 'khoahoc_ungdung_ai_truyentranh.php'
    ]
];
?>
