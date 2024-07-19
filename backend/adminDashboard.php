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

    <style>
    .table th, .table td {
      vertical-align: middle;
    }
    .table th{
        background-color: black;
        color: white;
    }
  </style>

</head>
<body>
    <nav class = "navbar bg-dark text-light position-fixed top-0 start-0 w-100 py-3">
        <div class="container">
            <h3 class="hFont">Admin Panel</h3>
            <div class = "d-flex justify-content-center gap-4">
                <span><a href="" class="text-decoration-none text-light textFont fs-5">Dashboard</a></span>
                <span><a href="" class="text-decoration-none text-light textFont fs-5">Orders</a></span>
                <span><a href="" class="text-decoration-none text-light textFont fs-5">Products</a></span>
                <span><a href="" class="text-decoration-none text-light textFont fs-5">Users</a></span>
            </div>
            <?php echo $adminAvatar ?>
        </div>
    </nav>

    <div class="py-5" style="background-color: #161b40;">
        <div class = "container pt-5 vh-100">
            <h2 class ="hFont text-center text-light fw-bold py-3">Dashboard</h2>
            <hr class = "container text-light">

            <div class = "d-flex flex-wrap gap-3 justify-content-evenly container mt-5">

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Current Users</a></h5>
                        <h3 class = "text-center">5</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Orders</a></h5>
                        <h3 class = "text-center">10</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Laptops</a></h5>
                        <h3 class = "text-center">50</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Mobiles</a></h5>
                        <h3 class = "text-center">100</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                <div class="bg-dark text-light rounded p-3 py-5">
                    <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Smart Watches</a></h5>
                    <h3 class = "text-center">80</h3>
                </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#" class = "text-decoration-none text-light">Sales</a></h5>
                        <h3 class = "text-center">50</h3>
                    </div>
                </div>
            </div>
            <hr class = "text-light" style = "margin-top: 8rem">
        </div>

        <!-- orders section start here  -->
        <div class="">
            <div class = "container py-5 vh-100">
                <h2 class ="hFont text-center text-light fw-bold py-3">Orders</h2>
                <hr class = "container text-light">

                <!-- order's table section -->
                 <div class = "p-3 text-light">
                    <h3 class ="text-center text-light">Current Orders</h3>
                    <table class = "table table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan = "3">SN</th>
                                <th rowspan = "3">Name</th>
                                <th colspan = "6">Products</th>
                                <th rowspan = "3">Buying Date</th>
                                <th rowspan = "3">Total Price</th>
                            </tr>

                            <tr>
                                <th colspan = "2">Laptop</th>
                                <th colspan = "2">Mobile</th>
                                <th colspan = "2">Smart Watch</th>
                            </tr>

                            <tr>
                                <th>Quantity</th>
                                <th>Price</th>

                                <th>Quantity</th>
                                <th>Price</th>

                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Rohit</td>
                                <td>2</td>
                                <td>100000</td>
                                <td>1</td>
                                <td>20000</td>
                                <td>3</td>
                                <td>12000</td>
                                <td>7/2024/7</td>
                                <td>200000</td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>


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