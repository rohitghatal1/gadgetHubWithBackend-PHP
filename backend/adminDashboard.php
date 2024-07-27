<?php
require 'database/databaseConnection.php';
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
        .hFont{
            font-family: 'Merienda', cursive;
        }
        .textFont{
            font-family: 'Poppins', sans-serif;
        }
        html{
            scroll-behavior: smooth;
        }
        body::-webkit-scrollbar {
            width: 5px;
            background: transparent;
        }

        body::-webkit-scrollbar-track {
            background-color: #4D648D;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #0A1828;
            border-radius: 0.6rem; 
        }
        .addMoreBtn{
            background-color: #161b40;
            color: #fff;
            border: 1px solid #fff;
        }

        .addMoreBtn:hover{
            background-color: #fff;
            color: #161b40;
            border: none;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th{
            background-color: black;
            color: white;
            padding: 0.5rem
        }
    </style>

</head>
<body>
    <nav class = "navbar bg-dark text-light position-fixed top-0 start-0 z-3 w-100 py-3">
        <div class="container">
            <h3 class="hFont">GadgetHub - Admin</h3>
            <div class = "d-flex justify-content-center gap-4">
                <span><a href="#dashboard" class="text-decoration-none text-light textFont fs-5">Dashboard</a></span>
                <span><a href="#orders" class="text-decoration-none text-light textFont fs-5">Orders</a></span>
                <span><a href="#products" class="text-decoration-none text-light textFont fs-5">Products</a></span>
                <span><a href="#users" class="text-decoration-none text-light textFont fs-5">Users</a></span>
                <span><a href="#sales" class="text-decoration-none text-light textFont fs-5">Sales</a></span>
            </div>
            <?php echo $adminAvatar ?>
        </div>
    </nav>

    <div class="pt-5 pb-2" style="background-color: #161b40;">
        <!-- dashboard section  -->
        <div class = "container pt-5 vh-100 border-bottom border-light-subtle" id = "dashboard">
            <h2 class ="hFont text-center text-light fw-bold py-5">Dashboard</h2>
            <hr class = "container text-light">

            <div class = "d-flex flex-wrap gap-3 justify-content-evenly container mt-5">

            <?php
                // for counting number of users 
                $getAllusers = "SELECT count(Id) AS totalUsers FROM users";
                $allUsers = $conn->query($getAllusers);
                $users = $allUsers->fetch_assoc();
                $currentUsers = $users['totalUsers'];

                // for counting number of laptop available 
                $getAllLaptops= "SELECT count(Id) AS totalLaptops FROM laptops";
                $allLaptops = $conn->query($getAllLaptops);
                $laptops = $allLaptops->fetch_assoc();
                $currentLaptops = $laptops['totalLaptops'];

                // for counting number of mobiles available
                $getAllMobiles = "SELECT count(Id) AS totalMobiles FROM mobiles";
                $allMobiles = $conn->query($getAllMobiles);
                $mobiles = $allMobiles->fetch_assoc();
                $currentMobiles = $mobiles['totalMobiles'];

                // for counting number of smart watches 
                $getAllwatches = "SELECT count(Id) AS totalWatches FROM watches";
                $allwatches = $conn->query($getAllwatches);
                $watches = $allwatches->fetch_assoc();
                $currentWatches = $watches['totalWatches'];

                // for counting all sales
                $getAllSales = "SELECT count(SId) AS totalSales FROM sales";
                $allSales = $conn->query($getAllSales);
                $sales = $allSales->fetch_assoc();
                $currentSales = $sales['totalSales'];

                // for counting number of orders
                $getAllOrders = "SELECT count(OId) AS totalOrders FROM orders";
                $allOrders = $conn->query($getAllOrders);
                $orders = $allOrders->fetch_assoc();
                $currentOrders = $orders['totalOrders'];

            ?>
                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#laptops" class = "text-decoration-none text-light">Laptops</a></h5>
                        <h3 class = "text-center"><?php echo $currentLaptops ?></h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#mobiles" class = "text-decoration-none text-light">Mobiles</a></h5>
                        <h3 class = "text-center"><?php echo $currentMobiles ?></h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#smartWatches" class = "text-decoration-none text-light">Smart Watches</a></h5>
                        <h3 class = "text-center"><?php echo $currentWatches ?></h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#users" class = "text-decoration-none text-light">Current Users</a></h5>
                        <h3 class = "text-center"><?php echo $currentUsers ?></h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#orders" class = "text-decoration-none text-light">Orders</a></h5>
                        <h3 class = "text-center"><?php echo $currentOrders ?></h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#sales" class = "text-decoration-none text-light">Sales</a></h5>
                        <h3 class = "text-center"><?php echo $currentSales ?></h3>
                    </div>
                </div>

            </div>
        </div>
        <!-- dashboard section end  -->

        <!-- orders section start here  -->
        <div class="py-3 vh-100 border-bottom border-light-subtle" id ="orders">
            <div class = "container py-5 vh-100">
                <h2 class ="hFont text-center text-light fw-bold py-3">Orders</h2>
                <hr class = "container text-light">

                <!-- order's table section -->
                 <div class = "p-3 text-light">
                    <h3 class ="text-center text-light">Current Orders</h3>
                    <table class = "table table-bordered text-center">
                        <thead class="">
                            <tr>
                                <th rowspan = "3">SN</th>
                                <th rowspan = "3">Name</th>
                                <th colspan = "6">Products</th>
                                <th rowspan = "3">Ordered Date</th>
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
                        <?php 
                            $ordersData = "SELECT * FROM orders";
                            $fetchedOrderData = $conn->query($ordersData);
                            $Ocount = 1;
                            if($fetchedOrderData->num_rows>0){
                                while($orderInfo = $fetchedOrderData->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $salesInfo['Cname'] ?></td>
                                    <td><?php echo $userInfo['laptopQty'] ?></td>
                                    <td><?php echo $userInfo['Lprice'] ?></td>
                                    <td><?php echo $userInfo['mobileQty'] ?></td>
                                    <td><?php echo $userInfo['Mprice'] ?></td>
                                    <td><?php echo $userInfo['watchQty'] ?></td>
                                    <td><?php echo $userInfo['price'] ?></td>
                                    <td><?php echo $userInfo['orderedDate'] ?></td>
                                    <td><?php echo $userInfo['totalPrice'] ?></td>
                                </tr>
                                <?php
                                $count++;
                                }
                            }
                            else{
                                echo "<tr>";
                                echo "<td colspan = '10'>No orders at the moment🥲!!!</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
        <!-- order secttion end  -->

        <!-- product section  -->
        <div class="py-5 border-bottom border-light-subtle" id = "products">
            <h2 class = "text-center text-light hFont py-5">Products</h2>
            <!-- <hr class = "container text-light"> -->

            <!-- laptops section  -->
            <div class="py-2 container" id = "laptops">
                <h3 class="text-left text-light hFont">Laptops</h3>
                <hr class = "container text-light">

                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn addMoreBtn" data-bs-toggle="modal" data-bs-target="#addLaptop"><i class="fas fa-plus"></i>
                        Add more
                    </button>
                </div>

                <!-- add laptop Modal -->
                <div class="modal fade" id="addLaptop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #161b40; color:#fff">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Laptops</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addLaptops.php" method = "post" enctype = "multipart/form-data">
                                <label class="form-label mt-2">Photo</label>
                                <input type="file" name ="laptopPhoto" accept =".jpg, .png, .jpeg">

                                <label class="form-label d-block mt-2">Brand</label>
                                <input type="text" name = "brand" class="form-control">
                                
                                <label class="form-label mt-2">Model</label>
                                <input type="text" name="model" class="form-control">
                                
                                <label class="form-label mt-2">Processor</label>
                                <input type="text" name="processor" class="form-control">
                                
                                <label class="form-label mt-2">RAM</label>
                                <input type="text" name ="RAM" class="form-control">
                                
                                <label class="form-label mt-2">Graphics</label>
                                <input type="text" name = "graphics" class="form-control">
                                
                                <label class="form-label mt-2">Other Specifications</label>
                                <textarea class="form-control" name = "specifications"></textarea>

                                <label class="form-label mt-2">Price</label>
                                <input type="text" name ="price" class="form-control">

                                <input type="submit" value ="Add" class="btn btn-success text-light mt-3" style="background-color: #161b40; color#fff; border:1px solid #fff">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <?php require 'php/laptopDisplayTable.php'; ?>
            </div>

            <!-- mobiles section  -->
            <div class="py-2 container" id = "mobiles">
                <h3 class="text-left text-light hFont">Mobile Phones</h3>
                <hr class = "container text-light">
                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn addMoreBtn" data-bs-toggle="modal" data-bs-target="#addMobile"><i class="fas fa-plus"></i>
                        Add more
                    </button>
                </div>

                <!-- add mobiles Modal -->
                <div class="modal fade" id="addMobile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #161b40; color:#fff">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Mobiles</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addMobiles.php" method = "post" enctype = "multipart/form-data">
                                <label class="form-label mt-2">Photo</label>
                                <input type="file" name = "mobilePhoto" accept =".jpg, .png, .jpeg">

                                <label class="form-label d-block mt-2">Brand</label>
                                <input type="text" name = "brand" class="form-control">
                                
                                <label class="form-label mt-2">Model</label>
                                <input type="text" name = "model" class="form-control">
                                
                                <label class="form-label mt-2">Processor</label>
                                <input type="text" name = "processor" class="form-control">
                                
                                <label class="form-label mt-2">RAM</label>
                                <input type="text" name = "RAM" class="form-control">

                                <label class="form-label mt-2">Storage</label>
                                <input type="text" name = "storage" class="form-control">

                                <label class="form-label mt-2">Other Specifications</label>
                                <textarea class="form-control" name = "specifications"></textarea>

                                <label class="form-label mt-2">Price</label>
                                <input type="text" name = "price" class="form-control">

                                <input type="submit" value ="Add" class="btn btn-success text-light mt-3" style="background-color: #161b40; color#fff; border:1px solid #fff">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <?php require 'php/mobileDisplayTable.php' ?>
            </div>

            <!-- smart watch section  -->
            <div class="py-2 container" id = "smartWatches">
                <h3 class="text-left text-light hFont">Smart Watches</h3>
                <hr class = "container text-light">
                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn addMoreBtn" data-bs-toggle="modal" data-bs-target="#addSmartWatch"><i class="fas fa-plus"></i>
                        Add more
                    </button>
                </div>

                <!-- add smart watch Modal -->
                <div class="modal fade" id="addSmartWatch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #161b40; color:#fff">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Smart Watches</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addSmartWatch.php" method = "post" enctype = "multipart/form-data">

                                <label class="form-label mt-2">Photo</label>
                                <input type="file" name="watchPhoto" accept =".jpg, .png, .jpeg">

                                <label class="form-label d-block mt-2">Brand</label>
                                <input type="text" name="brand" class="form-control">
                                
                                <label class="form-label mt-2">Model</label>
                                <input type="text" name="model" class="form-control">
                                
                                <label class="form-label mt-2">Other Specifications</label>
                                <textarea class="form-control" name = "specifications"></textarea>

                                <label class="form-label mt-2">Price</label>
                                <input type="text" name = "price" class="form-control">

                                <input type="submit" value ="Add" class="btn btn-success text-light mt-3" style="background-color: #161b40; color#fff; border:1px solid #fff">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <?php require 'php/watchesDisplayTable.php' ?>
            </div>
        </div>
        <!-- product section end  -->

        <!-- users section  -->
        <div class="py-5 vh-100 border-bottom border-light-subtle" id = "users">
            <h2 class="text-center text-light py-5 hFont">Users</h2>
            <hr class="text-light container">

            <?php require 'php/userDisplayTable.php' ?>
        </div>

         <!-- sales section  -->
         <div class="py-5 vh-100 border-bottom border-light-subtle" id = "sales">
            <h2 class="text-center text-light py-5 hFont">Sales</h2>
            <hr class="text-light container">

            <div class="salesTable container">
                <h3 class="text-light hFont py-1">Total Sales</h3>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-font">
                            <th rowspan = "3">SN</th>
                            <th rowspan = "3">Date</th>
                            <th colspan = "6">Products</th>
                            <th rowspan = "3">Total</th>
                        </tr>
                        <tr>
                            <th colspan = "2">Laptop</th>
                            <th colspan = "2">Mobile</th>
                            <th colspan = "2">Smart Watch</th>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $salesData = "SELECT * FROM sales";
                        $fetchedSalesData = $conn->query($salesData);
                        $Scount = 1;
                        if($fetchedSalesData->num_rows>0){
                            while($salesInfo = $fetchedsalesData->fetch_assoc()){
                                ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $salesInfo['Date'] ?></td>
                                <td><?php echo $userInfo['laptopQty'] ?></td>
                                <td><?php echo $userInfo['price'] ?></td>
                                <td><?php echo $userInfo['mobileQty'] ?></td>
                                <td><?php echo $userInfo['Mprice'] ?></td>
                                <td><?php echo $userInfo['watchQty'] ?></td>
                                <td><?php echo $userInfo['Wprice'] ?></td>
                                <td><?php echo $userInfo['totalPrice'] ?></td>
                            </tr>
                            <?php
                            $count++;
                            }
                        }
                        else{
                            echo "<tr>";
                            echo "<td colspan = '9'>No sales at the moment🥲!!!</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
         <div class="container">
             <h3 class="text-center text-light hFont mt-4">Designed & Developed By Rohit Ghatal</h3>
         </div>
    </div>

</body>
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

<script>
// to delete a record
function confirmDelete(id, category) {
    if (confirm("Are you sure you want to delete?")) {
        deleteRecord(id, category);
    }
}

function deleteRecord(id, category) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'deleteFromTable.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                location.reload();
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.send("id=" + id + "&category=" + category);
}

</script>
<!-- bootstrap javaScript  -->
<script src="../frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>