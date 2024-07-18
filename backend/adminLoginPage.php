<?php 
session_start();

if(isset($_SESSION['adminUsername'])){
    header("location: adminDashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- bootstrap css  -->
    <link href="../frontend/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body{
            background-image: url(blackBG.jpg);
        }
        .hFont{
            font-family: 'Merienda', cursive;
        }
        .textFont{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="adminLoginForm bg-body-tertiary rounded-2 overflow-hidden" style="width: 30rem;">

        <h2 class="bg-dark text-light fw-bold text-center py-2 hFont">Admin Login</h2>

        <form action="adminLoginScript.php" method="post" class="p-3">

            <input type="text" class="form-control mt-3 textFont" placeholder="admin username" name="adminUsername" oninput = "clearError()">
            <input type="password" class="form-control mt-3 textFont" placeholder="admin password" name="adminPassword" oninput = "clearError()">
            <?php
                if (isset($_GET['loginfailed'])) {
                    $errorMessage = htmlspecialchars($_GET['loginfailed']);
                    echo "<p class='text-danger' id='error-message'>$errorMessage</p>";
                }
            ?>

            <input type="submit" value="Login" class="btn btn-dark p-2 fw-bold text-center mt-2 textFont">

        </form>
    </div>
</body>

<!-- bootstrap javaScript  -->
<script src="../frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script>
function clearError() {
    const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        errorMessage.textContent = '';
    }
}
</script>
</html>