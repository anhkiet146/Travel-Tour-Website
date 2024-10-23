<?php
session_start();

// Xóa tất cả các biến phiên
$_SESSION = array();

// Nếu sử dụng cookie, hãy xóa cookie phiên
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Cuối cùng, hủy phiên
session_destroy();

// Chuyển hướng về trang home
header("Location: home.php");
exit();
?>
