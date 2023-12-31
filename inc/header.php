<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <!-- Left -->
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Home</a>
  </div>

  <?php
  if (isset($_SESSION['UID']) and basename($_SERVER['SCRIPT_NAME'], ".php") !== 'logout') {
    ?>
    <!-- Center -->
    <div class="container-fluid justify-content-center">
      <div class="d-flex flex-grow-1 justify-content-center">
        <ul class="navbar-nav">
          <!-- Admin -->
          <?php if ($_SESSION['type'] === 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link" href="./dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./leave.php">Leaves</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./record.php">Record</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./staff.php">Staff</a>
            </li>
            <!-- Staff -->
          <?php } elseif ($_SESSION['type'] === 'staff') { ?>
            <li class="nav-item">
              <a class="nav-link" href="./dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./leave.php">Apply</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./record.php">View</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <!-- Right -->
    <div class="container-fluid justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item dropstart">
          <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </button>
          <ul class="dropdown-menu">
            <li><span class="dropdown-item-text">
                <?php echo $_SESSION['UID'] ?>
              </span></li>
            <li><span class="dropdown-item-text">
                <?php echo $_SESSION['name'] ?>
              </span></li>
            <li>
              <a class="dropdown-item" style="color: #f44900" href="../user/logout.php">
                Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  <?php } ?>
</nav>