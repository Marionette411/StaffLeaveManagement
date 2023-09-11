<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Leaves</title>

    <style>
        table,
        th,
        td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 5px 10px;
            text-align: center;
        }
    </style>
</head>

<?php
if (!isset($_SESSION['UID'])) {
    echo "Please login to continue<br>";
    echo "Redirecting to login page...";
    die(header("refresh:3; URL=./login.php"));
}
if ($_SESSION['type'] != 'admin') {
    echo '<h2 style="color: red">Access Denied!!</h2>';
    echo 'Not an admin, Redirecting to dashboard...';
    die(header("refresh:3; URL=../staff/dashboard.php"));
}

require_once '../connect.php';

$tbname = "staff_leave";

$stmt = $conn->query("SELECT * FROM $tbname");
?>

<body>
    <h2>All Staff leaves</h2>

    <h3>Leave recorded: -</h3>

    <table>
        <tr>
            <th>UID</th>
            <th>Earned leave (EL)</th>
            <th>Casual leave (CL)</th>
            <th>Sick leave (SL)</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['UID']}</td>";
            echo "<td>{$row['EL']}</td>";
            echo "<td>{$row['CL']}</td>";
            echo "<td>{$row['SL']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href='./dashboard.php'>Dashboard</a>
</body>

</html>