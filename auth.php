<?php
session_start();
include __DIR__ . '/db.php';

function generateUID() {
    return bin2hex(random_bytes(16));
}

function registerUser($name, $email, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) return false;

    $uid = generateUID();
    $stmt = $db->prepare("INSERT INTO users (uid, name, email, password, is_admin) VALUES (?,?,?,?,0)");
    $stmt->execute([$uid, $name, $email, password_hash($password, PASSWORD_DEFAULT)]);
    return true;
}

function loginUser($email, $password) {
    global $db;

    session_unset();

    $stmt = $db->prepare("SELECT uid, name, email, role, is_admin, password FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['uid'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'] ?? 'Mängija';
        $_SESSION['is_admin']  = (int)($user['is_admin'] ?? 0);

        error_log("LOGIN OK: ".$_SESSION['user_name']." (is_admin=".$_SESSION['is_admin'].")");

        return true;
    } else {
        error_log("LOGIN FAIL: ".$email);
    }

    return false;
}

function checkAuth() {
    return isset($_SESSION['user_id']);
}

function checkAdmin() {
    if (empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
        header("Location: dashboard.php");
        exit;
    }
}

function logout() {
    session_unset();
    session_destroy();
}
?>
