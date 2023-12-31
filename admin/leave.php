<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Leaves</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link href="../style/main.css" rel="stylesheet">
    <link href="../style/table.css" rel="stylesheet">
</head>

<body>
    <?php require '../inc/header.php' ?>
    <div class="container-fluid text-center mt-3">
        <?php
        if (!isset($_SESSION['UID'])) {
            echo "Please login to continue<br>";
            echo "Redirecting to login page...";
            die(header("refresh:2; URL=./login.php"));
        }
        if ($_SESSION['type'] != 'admin') {
            echo '<h2 style="color: red">Access Denied!!</h2>';
            echo 'Not an admin, Redirecting to dashboard...';
            die(header("refresh:2; URL=../staff/dashboard.php"));
        }

        require_once '../inc/connect.php';

        $tbname = "staff_leave";

        $stmt = $conn->query("SELECT * FROM $tbname");

        if ($stmt->rowCount() < 1) {
            die("<p>No staffs found<br></p>");
        }
        ?>

        <h2>All Staff leaves</h2>
        <div class="d-flex justify-content-center">
            <hr>
        </div>

        <div class="d-flex justify-content-center mt-3 mb-3">
            <div class="overflow-auto">
                <table>
                    <tr>
                        <th>UID</th>
                        <th>Earned leave<br>(EL)</th>
                        <th>Casual leave<br>(CL)</th>
                        <th>Sick leave<br>(SL)</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['UID']}</td>";
                        echo "<td>{$row['EL']}</td>";
                        echo "<td>{$row['CL']}</td>";
                        echo "<td>{$row['SL']}</td>";
                        echo "<td>";
                        echo "<form action=\"./edit.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"stf_id\" value={$row['UID']}>";
                        echo "<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"Edit\">";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <form action="./edit_all.php" method="post">
            <input type="submit" name="submit" class="btn btn-primary" value="Edit All">
        </form>
    </div>
</body>

</html>