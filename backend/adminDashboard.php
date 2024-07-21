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

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#users" class = "text-decoration-none text-light">Current Users</a></h5>
                        <h3 class = "text-center">5</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#orders" class = "text-decoration-none text-light">Orders</a></h5>
                        <h3 class = "text-center">10</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#laptops" class = "text-decoration-none text-light">Laptops</a></h5>
                        <h3 class = "text-center">50</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#mobiles" class = "text-decoration-none text-light">Mobiles</a></h5>
                        <h3 class = "text-center">100</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#smartWatches" class = "text-decoration-none text-light">Smart Watches</a></h5>
                        <h3 class = "text-center">80</h3>
                    </div>
                </div>

                <div class="p-2 bg-info-subtle col-3 rounded">
                    <div class="bg-dark text-light rounded p-3 py-5">
                        <h5 class = "text-center"><a href="#sales" class = "text-decoration-none text-light">Sales</a></h5>
                        <h3 class = "text-center">50</h3>
                    </div>
                </div>

            </div>
        </div>
        <!-- dashboard section end  -->

        <!-- orders section start here  -->
        <div class="py-3 vh-100 border-bottom border-light-subtle" id ="orders">
            <div class = "container py-5 vh-100 border-bottom border-light-subtle">
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
        <!-- order secttion end  -->

        <!-- product section  -->
        <div class="py-5 border-bottom border-light-subtle" id = "products">
            <h2 class = "text-center text-light hFont py-5">Products</h2>
            <hr class = "container text-light">

            <!-- laptops section  -->
            <div class="py-2 container" id = "laptops">
                <h3 class="text-left text-light hFont">Laptops</h3>
                <hr class = "container text-light">

                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#addLaptop"><i class="fas fa-plus"></i>
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

                <div class ="p-2 mt-3">
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Photo</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Processor</th>
                                <th>RAM</th>
                                <th>Graphics</th>
                                <th>Other Specifications</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="../frontend/images/asus.jpg" alt="" class ="img-fluid" style = "width: 8rem; height:6rem;"></td>
                                <td>Lenovo</td>
                                <td>ThinkPad</td>
                                <td>Intel core i7</td>
                                <td>16GB</td>
                                <td>NVDIA GTX Geforce</td>
                                <td>512GB SSD, 15 in display, 360 Foldable</td>
                                <td><i class="fas fa-trash text-danger"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- mobiles section  -->
            <div class="py-2 container" id = "mobiles">
                <h3 class="text-left text-light hFont">Mobile Phones</h3>
                <hr class = "container text-light">

                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#addMobile"><i class="fas fa-plus"></i>
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
                            <form action="">
                                <label class="form-label mt-2">Photo</label>
                                <input type="file" accept =".jpg, .png, .jpeg">

                                <label class="form-label d-block mt-2">Brand</label>
                                <input type="text" class="form-control">
                                
                                <label class="form-label mt-2">Model</label>
                                <input type="text" class="form-control">
                                
                                <label class="form-label mt-2">Processor</label>
                                <input type="text" class="form-control">
                                
                                <label class="form-label mt-2">RAM</label>
                                <input type="text" class="form-control">

                                <label class="form-label mt-2">Other Specifications</label>
                                <textarea class="form-control"></textarea>

                                <input type="submit" value ="Add" class="btn btn-success text-light mt-3" style="background-color: #161b40; color#fff; border:1px solid #fff">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <div class ="p-2 mt-3">
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Photo</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Processor</th>
                                <th>RAM</th>
                                <th>Other Specifications</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="../frontend/images/samsung.jpg" alt="" class ="img-fluid" style = "width: 8rem; height:6rem;"></td>
                                <td>Samsung</td>
                                <td>S24 </td>
                                <td>Snapdragon</td>
                                <td>8GB</td>
                                <td>1TB storage, 108MP rear camera, 50MP front camera</td>
                                <td><i class="fas fa-trash text-danger"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- smart watch section  -->
            <div class="py-2 container" id = "smartWatches">
                <h3 class="text-left text-light hFont">Smart Watches</h3>
                <hr class = "container text-light">
                
                <div class="d-flex justify-content-between mt-3 container">
                    <h4 class= "hFont text-light">Current Stock</h4>
                    <button type="button" class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#addSmartWatch"><i class="fas fa-plus"></i>
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
                            <form action="">
                                <label class="form-label mt-2">Photo</label>
                                <input type="file" accept =".jpg, .png, .jpeg">

                                <label class="form-label d-block mt-2">Brand</label>
                                <input type="text" class="form-control">
                                
                                <label class="form-label mt-2">Model</label>
                                <input type="text" class="form-control">
                                
                                <label class="form-label mt-2">Other Specifications</label>
                                <textarea class="form-control"></textarea>

                                <input type="submit" value ="Add" class="btn btn-success text-light mt-3" style="background-color: #161b40; color#fff; border:1px solid #fff">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <div class ="p-2 mt-3">
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Photo</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Other Specifications</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="../frontend/images/smartwatch.jpg" alt="" class ="img-fluid" style = "width: 8rem; height:6rem;"></td>
                                <td>Lenovo</td>
                                <td>ThinkPad</td>
                                <td>4GB RAM, 5cm display, 10MP Camera</td>
                                <td><i class="fas fa-trash text-danger"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- product section end  -->

        <!-- users section  -->
         <div class="py-5 vh-100 border-bottom border-light-subtle" id = "users">
            <h2 class="text-center text-light py-5 hFont">Users</h2>
            <hr class="text-light container">

            <div class="usersTable container">
                <h3 class="text-light hFont py-1">Current Users</h3>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-font">
                            <th>SN</th>
                            <th>UId</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $userData = "SELECT * FROM users";
                        $fetchedUserData = $conn->query($userData);
                        $count = 1;
                        if($fetchedUserData->num_rows>0){
                            while($userInfo = $fetchedUserData->fetch_assoc()){
                                ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $userInfo['uId'] ?></td>
                                <td><?php echo $userInfo['uName'] ?></td>
                                <td><?php echo $userInfo['uAddress'] ?></td>
                                <td><?php echo $userInfo['uContact'] ?></td>
                                <td><?php echo $userInfo['uEmail'] ?></td>
                                <td><?php echo $userInfo['username'] ?></td>
                                <td><i class = "fas fa-trash text-danger"></i></td>
                            </tr>
                            <?php
                            $count++;
                            }
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

<!-- bootstrap javaScript  -->
<script src="../frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>