<?php
session_start();
if (isset($_SESSION['adminUsername'])) {
    $username = $_SESSION['adminUsername'];
    $firstLetterAvatar = strtoupper(substr($username, 0, 1));
    $adminAvatar = <<<dropdown
            <div class="userDropdown position-relative">
                <div class="avatar mb-1 bg-danger p-1 px-2 me-3 text-center rounded-circle" onclick="toggleDropdown(event);">$firstLetterAvatar</div>

                <div class="dropdown-container bg-dark p-3 px-5 me-2 rounded z-3" id="droppedDownContent" style="position:absolute; right:5px; display:none">
                    <h3 class="heading-font text-center">$firstLetterAvatar</h3>
                    <p class="text-font">$username</p>
                    <a id = "logout" href="logout.php" class="text-font text-center ms-3 text-decoration-none">Log out</a>
                </div>
            </div>
        dropdown;
}
else{
    header('location: adminLoginPage.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css  -->
    <link href="../frontend/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- link css link for fontawesome icons  -->
    <link rel="stylesheet" href="/gadgetHubWithBackend/frontend/fontawesome-free-6.5.2-web/css/all.min.css">

    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="css/dashboard.css">

</head>
<body>
    <nav class = "navbar bg-dark text-light">
        <div class="container">
            <h3 class="hFont">Admin Panel</h3>
            <div class = "d-flex justify-content-center gap-3">
                <span><a href="" class="text-decoration-none text-light textFont">Dashboard</a></span>
                <span><a href="" class="text-decoration-none text-light textFont">Orders</a></span>
                <span><a href="" class="text-decoration-none text-light textFont">Products</a></span>
                <span><a href="" class="text-decoration-none text-light textFont">Users</a></span>
            </div>
            <?php echo $adminAvatar ?>
        </div>
    </nav>

    <script>
        document.addEventListener('click', function(event) {
            var dropdownContent = document.getElementById("droppedDownContent");
            var userDropdown = document.querySelector('.userDropdown');
            
            if (dropdownContent && !userDropdown.contains(event.target)) {
                dropdownContent.style.display = "none";
            }
        });

        function toggleDropdown(event) {
            event.stopPropagation(); // Prevent the document click listener from immediately hiding the dropdown
            var dropdownContent = document.getElementById("droppedDownContent");
            if (dropdownContent.style.display === "block") {
            console.log('button clicked');
            dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        }
</script>
</body>

<!-- bootstrap javaScript  -->
<script src="../frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>