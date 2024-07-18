<?php
    $loginBtn = "";
    session_start();
    if(isset($_SESSION['adminUsername'])){
        $adminUsername = $_SESSION['adminUsername'];
        $firstLetter = strtoupper(substr($adminUsername, 0, 1));
        $loginBtn = <<<dropdown
            <div class="adminDropdown">
                <div class="avatar" onclick="toggleDropdown()">$firstLetter</div>
                <div class="dropdown-content" id="droppedDownContent">
                    <h3 class="heading-font">$firstLetter</h3>
                    <p class="text-font">$adminUsername</p>
                    <a id = "logout"href="../php/logout.php">Log out</a>
                </div>
            </div>
        dropdown;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css  -->
    <link href="../frontend/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="css/dashboard.css">

</head>
<body>
    <nav class = "navbar bg-dark text-light">
        <div class="container">
            <h3>Admin Panel</h3>
            <div class = "d-flex justify-content-center">
                <span><a href="">Dashboard</a></span>
                <span><a href="">Orders</a></span>
                <span><a href="">Products</a></span>
                <span><a href="">Users</a></span>
            </div>
            <div class="avatar">login</div>
        </div>
    </nav>
</body>

<!-- bootstrap javaScript  -->
<script src="../frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>