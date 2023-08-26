<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    echo '<h2 style="color: red">Access Denied!!</h2>';
    echo 'Redirecting...';
    die(header("refresh:3; URL=../index.php"));
}

require_once '../connect.php';

$tbname = "admin_login";
$uid = $_POST["uid"];
$passwd = $_POST["passwd"];

$stmt = $conn->query("SELECT passwd from {$tbname} where uid='{$uid}'");
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() < 1) {
    echo "No such user $uid present";
    echo '<br>';
    echo "<a href='./register.php'>Register here</a> ";
    echo "or <a href='./login.php'>login again</a>";
} else {
    if (password_verify($passwd, $data['passwd'])) {
        $_SESSION['UID'] = $uid;
        $_SESSION['type'] = 'admin';
        echo "{$uid} succesfully logged in<br>";
        echo "Redirecting to dashboard...";
        header("refresh:3; URL=./dashboard.php");
    } else {
        echo "Wrong password<br>";
        echo "Redirecting to login...";
        header("refresh:3; URL=./login.php");
    }
}