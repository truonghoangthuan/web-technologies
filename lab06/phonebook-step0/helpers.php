<?php

if (!function_exists('redirect')) {
    // Chuyển hướng đến một trang khác
    function redirect($location, array $data = [])
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }

        header('Location: ' . $location);
        exit();
    }
}

if (!function_exists('session_get_once')) {
    // Đọc và xóa một biến trong $_SESSION
    function session_get_once($name, $default = null)
    {
        $value = $default;
        if (isset($_SESSION[$name])) {
            $value = $_SESSION[$name];
            unset($_SESSION[$name]);
        }
        return $value;
    }
}

// Hàm api thông báo gửi json thành công.
if (!function_exists('send_json_success')) {
    function send_json_success(array $data = null, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
        exit();
    }
}

// Hàm thông báo gửi json không thành công.
if (!function_exists('send_json_fail')) {
    function send_json_fail(array $data = null, $code = 400)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'fail',
            'data' => $data
        ]);
        exit();
    }
}

// Hàm thông báo gửi json lỗi.
if (!function_exists('send_json_error')) {
    function send_json_error($message, array $data = null, $code = 500)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'fail',
            'message' => $message,
            'data' => $data
        ]);
        exit();
    }
}
