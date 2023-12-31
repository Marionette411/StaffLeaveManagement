<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    echo '<h2 style="color: red">Access Denied!!</h2>';
    echo 'Redirecting...';
    die(header("refresh:2; URL=../index.php"));
}

date_default_timezone_set("Asia/Kolkata");

$host = "localhost"; /* Host name */
$user = "R35"; /* User */
$password = "R35"; /* Password */
$dbname = "r35"; /* Database name */

try {
    // create a PDO instance to represent a connection to the requested database
    $conn = new PDO("mysql:host={$host}; dbname={$dbname}", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Successful.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die("<br><a href='../index.php'>Homepage</a>");
}