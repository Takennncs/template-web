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
    $stmt = $db->prepare("INSERT INTO users (uid, name, email, password) VALUES (?,?,?,?)");
    $stmt->execute([$uid, $name, $email, password_hash($password, PASSWORD_DEFAULT)]);
    return true;
}

function loginUser($email, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['uid'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }
    return false;
}

function checkAuth() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_destroy();
}
