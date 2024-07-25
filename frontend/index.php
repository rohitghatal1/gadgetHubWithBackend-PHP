<?php
require '../backend/database/databaseConnection.php';
$userAvatar = '<div class="user me-3" onclick="openLoginModal()"><i class="fa-solid fa-user"></i></div>';
session_start();
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $uid = $_SESSION['userId'];
    $firstLetterAvatar = strtoupper(substr($username, 0, 1));
    $userAvatar = <<<dropdown
            <div class="userDropdown position-relative">
                <div class="avatar mb-1 bg-danger p-1 px-2 me-3 text-center rounded-circle" onclick="toggleDropdown(event);">$firstLetterAvatar</div>

                <div class="dropdown-container bg-dark p-3 px-5 me-2 rounded z-3" id="droppedDownContent" style="position:absolute; right:5px; display:none">
                    <h3 class="heading-font text-center">$firstLetterAvatar</h3>
                    <p class="text-font">$username</p>
                    <p class="text-font myBooking text-center"><a href="userPage.php?userId={$uid}" class="text-decoration-none">My cart</a></p>
                    <a id = "logout"href="../../backend/logout.php" class="text-font text-center ms-3 text-decoration-none">Log out</a>
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
  <title>GadjetHub</title>

  <link rel="stylesheet" href="/gadgetHubWithBackend/frontend/css/style.css">
<link rel="icon" href="/gadgetHubWithBackend/frontend/logos/favicon1.png">
<!-- bootstrap css  -->
<link href="/gadgetHubWithBackend/frontend/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

<!-- link css link for fontawesome icons  -->
<link rel="stylesheet" href="/gadgetHubWithBackend/frontend/fontawesome-free-6.5.2-web/css/all.min.css">

<!-- google fonts  -->
<link
  href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
  rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Demo styles -->
<style>
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90%;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
  }

  .card{
    height: 100%
  }

  .table th, .table td {
      vertical-align: middle;
      text-align:center;
    }
    .table th{
        background-color: black;
        color: white;
        padding: 0.5rem
    }

    button:active{
      transform: scale(0.8);
    }
</style>

</head>

<body>

  <!-- login and signup modals  -->
  <div class="loginModal" id="loginModal">
    <div class="d-flex justify-content-between align-items-center">
      <h3><i class="fas fa-user"></i> User Login</h3>
      <span class="fs-3 closeLoginModal" onclick="closeLoginModal();">&times;</span>
    </div>
    <form method="post" action="../backend/userLogin.php">
      <label for="usernane" class="mt-2 form-label">Username</label>
      <input type="text" placeholder="Enter your usernane" name="uName" class="form-control">

      <label for="password" class="mt-2 form-label">Password</label>
      <input type="password" placeholder="Enter your password" name="uPassword" id="loginPassword" class="form-control">
      <span class="d-flex mt-2" onclick = "showPassword1();" style="cursor:pointer;"><input type="checkbox" class="form-check" id="checkbox"> Show Password</span>

      <input type="submit" value="Login" class="loginBtn fw-bold">
      <p class="mt-2">Don't have an account <span class="text-primary text-decoration-underline" onclick="openSignupModal()">Create account here.</span></p>
    </form>
  </div>

<div class="signupModal" id="signupModal">
    <div class="d-flex justify-content-between align-items-center">
        <h3><i class="fa-solid fa-user-pen"></i> Create an account</h3>
        <span class="fs-3 closeSignupModal" onclick="closeSignupModal();">&times;</span>
    </div>
    <form id="registerform" action="../../backend/userRegistration.php" method="post">
        <label class="mt-1 form-label">Full Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
        <div id="nameError" class="error-message"></div>

        <label class="mt-1 form-label">Address</label>
        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address">
        <div id="addressError" class="error-message"></div>

        <label class="mt-1 form-label">Contact No.</label>
        <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter your contact number">
        <div id="contactError" class="error-message"></div>

        <label class="mt-1 form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        <div id="emailError" class="error-message"></div>

        <label class="mt-1 form-label">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
        <div id="usernameError" class="error-message"></div>

        <label class="mt-1 form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Create a new password">
        <span class="d-flex mt-2" onclick = "showPassword();" style="cursor:pointer;"><input type="checkbox" class="form-check" id="checkboxInput"> Show Password</span>
        <div id="passwordError" class="error-message"></div>

        <label class="mt-1 form-label">Confirm Password</label>
        <input type="password" id="cPassword" class="form-control" placeholder="Re-type the password">
        <div id="cPasswordError" class="error-message"></div>

        <input type="submit" value="Submit" class="submitbtn fw-bold">
        <p class="mt-2">Already have an account? <span class="text-primary text-decoration-underline" onclick="openLoginModal()">Login here.</span></p>
        <div id="generalError" class="error-message"></div>
    </form>
</div>
  <!-- login and signup modal end here  -->

  <!-- mycartSection -->
   <div class="myCartModal rounded" id="myCart" style="display:none; position:fixed; top: 0; right:6rem; width:60rem; z-index:11; background-color: #c4dfe6">
    <div class="container p-2 d-flex justify-content-between align-items-center bg-dark text-light">
      <h2 class="hFont text-center p-1">My Cart ~ <?php echo "Rohit Ghatal";?></h2>
      <span style="font-size:2rem; cursor:pointer;" onclick="closeMyCart()">&times;</span>
    </div>
    <h4 class="textFont p-1 container">Items Added to cart</h4>
    <div class="itemsTable container">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Items</th>
            <th>Photo</th>
            <th>Price</th>
            <th>Date</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Laptop</td>
            <td><img src="images/asus.jpg" alt="" style="width:80%; height:8rem"></td>
            <td>50000</td>
            <td>2081/05/04</td>
            <td><a href="removeFromcart.php" class="text-decoration-none p-1 bg-danger text-light fw-bold rounded"><i class="fas fa-trash"></i> Remove</a></td>
          </tr>
        </tbody>
      </table>
    </div>
   </div>
  
  <?php 
    $getCartItems = "SELECT count(cId) AS totalCartItems FROM cart";
    $cartItems = $conn->query($getCartItems);
    $cartItem = $cartItems->fetch_assoc();
    $allCartItems = $cartItem['totalCartItems'];
  ?>
  <!-- ----------------------------------------------------Navbar  section--------------------------------------------- -->
  <header id="start">
    <div class="address pt-3 d-flex justify-content-between">
      <div class="socialIcons d-flex ms-5">
        <span class="ms-3"><a href="https://www.facebook.com/rohit.rohit.ghatal/" target="_blank"><i
              class="fab fa-facebook w-50"></i></a></span>
        <span class="ms-3"><a href="https://www.instagram.com/_rohit.ghatal_/" target="_blank"><i
              class="fab fa-instagram w-50"></i></a></span>
      </div>

      <div class="contact me-5 d-flex">
        <span class="me-3"><i class="fa fa-phone"></i> 9856435452</span>
        <span class="me-3"><i class="fa fa-phone"></i> 9856435452</span>
        <div class="cartAndLogin d-flex me-2">
          <?php echo $userAvatar ?>
          <div class="cartAndQuantity" onclick="openMyCart();">
            <div class="cart"><i class="fas fa-shopping-cart"></i></div>
            <span class="quantity d-flex justify-content-center align-items-center"><label class="mt-1" style="font-size:15px;"><?php echo $allCartItems ?></label></span>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar py-3" id="top">
      <div class="container d-flex align-items-center" id="navItemContainer">
        <div class="logo col-auto"><img src="/gadgetHubWithBackend/frontend/logos/gadgetHub3.png"></div>
        <div class="navitems">
          <span class="cursor"><a href="index.html">Home</a></span>
          <span><a href="#services">Services</a></span>
          <span><a href="#productsSection">Products</a></span>
          <span><a href="#aboutSection">About Us</a></span>
          <span><a href="#contactSection">Contact Us</a></span>
        </div>
      </div>
    </nav>
  </header>
  <!-- -----------------------------------------------Navbar section end -------------------------------------------------------- -->

  <!-- ----------------------------------------------------Website banner section------------------------------------------------ -->
  <div class="banner">
    <div class="photo" style = "witdh: 100%; height:40rem">
      <img src="images/banner1.jpg" alt="" class="img-fluid" style="width:100%; height:100%">
    </div>
    <div class="bannerDesc">
      <h2>The best place</h2>
      <h2>To buy <span id="products"></span><span class="tcursor">|</span></h2>
      <h2>In Affordable price</h2>
    </div>
  </div>

  <div class="services py-5" id="services">
    <h2 class="w-100 text-center">Services</h2>
    <div class="container mt-3 d-flex gap-5">

      <div class="service">
        <i class="fas fa-shopping-cart"></i>
        <div class="serviceDetail">
          <h5>FREE DELIVERY</h5>
          <p>We provide the free home delivery service</p>
        </div>
      </div>

      <div class="service">
        <i class="fa-solid fa-medal"></i>
        <div class="serviceDetail">
          <h5>QUALITY GUARANTEE</h5>
          <p>We sell the best quality products</p>
        </div>
      </div>
      <div class="service">
        <i class="fa-solid fa-tag"></i>
        <div class="serviceDetail">
          <h5>DAILY OFFERS</h5>
          <p>We provide the best daily offers</p>
        </div>
      </div>
      <div class="service">
        <i class="fa-solid fa-shield"></i>
        <div class="serviceDetail">
          <h5>SECURE PAYMENT</h5>
          <p>We have integrated the security mechanisms for payment</p>
        </div>
      </div>
    </div>
  </div>

  <!-- --------------------------------------------------------Banner sectin end--------------------------------------------------- -->


  <!-- -------------------------------------------------------------Products Section ---------------------------------------------- -->
  <section class="productSection py-3" id="productsSection">
    <h2 class="text-center py-2">Our Products</h2>
    <div class="productsContainer container">
      <div class="mobleProducts px-2">
        <h2 class="pt-3">Mobiles</h2>
          <!-- Swiper -->
            <div class="container">
              <div class="swiper mySwiper" style = "height: 32rem">
                <div class="swiper-wrapper">

                <!-- to display all mobies  -->
                  <?php require 'php/mobileCards.php'?>
                
                </div>
              <div class="swiper-pagination" style="margin-top: -2rem"></div>
            </div>
          </div>
      </div>

      <div class="smartWatchProducts px-2 my-4">
        <h2 class="pt-3">Smart Watches</h2>
                     <!-- Swiper -->
            <div class="container">
              <div class="swiper mySwiper" style = "height: 32rem">
                <div class="swiper-wrapper">

                <!-- to display all mobies  -->
                  <?php require 'php/watchCards.php'?>
                
                </div>
              <div class="swiper-pagination"></div>
            </div>
      </div>

      <div class="laptopProducts px-2 my-4">
        <h2 class="pt-3">Laptops</h2>
                  <!-- Swiper -->
            <div class="container">
              <div class="swiper mySwiper" style = "height: 32rem">
                <div class="swiper-wrapper">

                <!-- to display all mobies  -->
                  <?php require 'php/laptopCards.php'?>
                
                </div>
              <div class="swiper-pagination"></div>
            </div>

        </div>
      </div>
    </div>
  </section>
  <!-- ---------------------------------------------------------------------Products  section end ----------------------------------------  -->

  <!-- ------------------------------------------------------------------------about us Section ------------------------------------------------  -->
  <section class="aboutSection py-5" id="aboutSection">
    <div class="container aboutUsContainer">
      <h2 class="text-center py-2">About Us</h2>
      <div class="row">
        <div class="col-md-6">
          <img src="/gadgetHubWithBackend/frontend/images/abouUs.webp" alt="About Us" class="img-fluid">
        </div>
        <div class="col-md-6">
          <p>
            Welcome to GadgetHub, your one-stop shop for the latest and greatest in mobiles, smartwatches, and
            laptops. Established in 2020, we have been committed to providing our customers with top-quality products
            and exceptional service.
          </p>
          <p>
            At GadgetHub, we believe in offering only the best. Our team of experts carefully selects and tests each
            product to ensure it meets our high standards of quality and performance. We are passionate about technology
            and strive to bring you the newest and most innovative gadgets on the market.
          </p>
          <p>
            Our mission is to make technology accessible and affordable for everyone. We offer a wide range of products
            to suit every need and budget, along with exclusive deals and promotions to help you save.
          </p>
          <p>
            What sets us apart is our dedication to customer satisfaction. From free delivery to secure payment options,
            we go the extra mile to ensure a seamless shopping experience. Thank you for choosing GadgetHub. We look
            forward to serving you!
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="contactUsSection py-5" id="contactSection">
    <h2 class="text-center">Contact Us</h2>
    <div class="contactUsContainer container d-flex justify-content-between gap-1">
      <div class="sendMessageSection p-3">
        <h2 class="text-center">Send Message</h2>
        <form action="#" class="w-75 m-auto">
          <input class="sendMessageInputs" type="text" placeholder="Your Name">
          <input class="sendMessageInputs" type="email" placeholder="Your Email">
          <input class="sendMessageInputs" type="text" placeholder="Subject">
          <textarea class="sendMessageInputs" rows="6" placeholder="Message"></textarea>
        </form>
      </div>
      <div class="getInTouchSection p-3">
        <h2 class="text-center">Get in touch</h2>
        <p>If you have any queries or inquiries, feel fee to get in touch with us with the following details.</p>
        <div class="contactDetails">
          <p><strong><i class="fas fa-envelope"></i> Email:</strong> rohitghatal@gmail.com</p>
          <p><strong><i class="fas fa-phone"></i> Phone:</strong> 9806415229</p>
          <p><strong><i class="fas fa-location"></i> Address:</strong> Thasikhel, Lalitpur</p>
        </div>

        <div class="socialMedia mt-3">
          <h3 class="mt-3">Follow us on:</h3>
          <a href="" class="socialIcons ms-3"><i class="fab fa-facebook"></i> Facebook</a>
          <a href="" class="socialIcons ms-3"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
      </div>
    </div>
  </section>

  <div class="goTotopBtn" id="goToTop">
    <a href="#start">&#x5e;</a>
    <span< /span>
  </div>
  <div class="feedbackbtn" onclick="openFeedbackForm()">
    <h5>Feedback <i class="fa-solid fa-pen"></i></h5>
  </div>

  <div class="feedBackForm" id="feedbackForm">
    <div class="feedbackHeading d-flex justify-content-between align-items-center">
      <h3 class="text-center">Give Feedback</h3>
      <span class="fs-5 closeFeedback" onclick="closeFeedbackForm()">&times;</span>
    </div>

    <div class="formContainer mt-3">
      <form action="#">
        <label for="name">Name</label>
        <input class="feedbackInputs" type="text" placeholder="Your name">

        <label for="email">Email</label>
        <input class="feedbackInputs" type="email" placeholder="Your email">

        <label for="contact">Contact No.</label>
        <input class="feedbackInputs" type="text" placeholder="Your contact number">

        <label for="feedback">Feedback</label>
        <textarea class="feedbackInputs" placeholder="Feedback" rows="6"></textarea>

        <input type="submit" class="submitFeedback" value="Submit">
      </form>
    </div>
  </div>

  <footer class="py-3">
    <section class="footerSection container d-flex justify-content-between">

      <div class="about">
        <figure class="websiteLogo"><img src="/gadgetHubWithBackend/frontend/logos/gadgetHub3.png" alt=""></figure>
        <p>Hello! Welcome to GadgetHub, here we provide the best quality products in affordable price. Started in 2022
          we are prividing
          best deals for 2 years with good customer experience and support.
        </p>
      </div>

      <div class="tabLinks d-flex flex-column gap-2 ps-3">
        <h3>Scroll to:</h3>
        <span><a href="#top">Home</a></span>
        <span><a href="#services">Services</a></span>
        <span><a href="#productsSection">Products</a></span>
        <span><a href="#aboutSection">About Us</a></span>
        <span><a href="#contactSection">Contact Us</a></span>
      </div>

      <div class="socialAndRatings">
        <div class="socialSection d-flex flex-column gap-2">
          <h3>Follow us on:</h3>
          <span><a href="https://www.facebook.com/rohit.rohit.ghatal/" target="_blank"><i class="fab fa-facebook"></i>
              Facebook</a></span>
          <span><a href="https://www.instagram.com/_rohit.ghatal_/" target="_blank"><i class="fab fa-instagram"></i>
              Instagram</a></span>
        </div>

        <div class="ratingsContainer mt-4">
          <h3>Rate Us</h3>
          <div class="stars d-flex gap-1">
            <span class="star" data-value="1">&#9733;</span>
            <span class="star" data-value="2">&#9733;</span>
            <span class="star" data-value="3">&#9733;</span>
            <span class="star" data-value="4">&#9733;</span>
            <span class="star" data-value="5">&#9733;</span>
          </div>
          <p class="rating-text"></p>
        </div>
      </div>
    </section>
    <h5 class="text-center py-3">Designed and Developed by <i>Rohit Ghatal.</i></h5>
  </footer>
</body>

<!-- bootstrap javaScript  -->
<script src="/gadgetHubWithBackend/frontend/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

<!-- swiperjs CDN  -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

<script src="js/script.js"></script>
<script src="/gadgetHubWithBackend/frontend/js/formValidation.js"></script>
  <script>
      // script to open and close my cart modal 
    let myCart = document.getElementById("myCart");
    function openMyCart(){
        myCart.style.display = "block";
    }

    function closeMyCart(){
        myCart.style.display = "none";
    }
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
      function showPassword(){
            let passwordInput = document.getElementById("password");
            let checkbox = document.getElementById("checkboxInput");
            
            checkbox.checked = !checkbox.checked;

            if(passwordInput.type == "password"){
                passwordInput.type = "text";
            }
            else{
                passwordInput.type = "password";
            }
        }
      function showPassword1(){
            let passwordInput = document.getElementById("loginPassword");
            let checkbox = document.getElementById("checkbox");
            
            checkbox.checked = !checkbox.checked;

            if(passwordInput.type == "password"){
                passwordInput.type = "text";
            }
            else{
                passwordInput.type = "password";
            }
      }
  </script>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- script for swiper  -->
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>

  <!-- for checking user login on add to cart  -->
  <script>
    function handleAddToCart(mobileId) {
        <?php if (isset($_SESSION['user'])) { ?>
            try {
                let userId = <?php echo $_SESSION['userId']; ?>;
                if (!userId) {
                    throw new Error('User ID not found in session.');
                }
                console.log(userId);
                console.log(mobileId);
                
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "php/addToCart.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        let response = JSON.parse(xhr.responseText);
                        if (xhr.status === 200 && response.status === 'success') {
                            alert(response.message); // Show success message
                            alert("Added to cart successfully");
                        } else {
                            console.error('Error adding to cart:', response.message);
                            alert('An error occurred while adding to cart. Please try again later.');
                        }
                    }
                };
                xhr.send("userId=" + userId + "&mobileId=" + mobileId);

            } catch (error) {
                console.error('Error handling add to cart:', error.message);
                alert('An error occurred while processing your request. Please try again later.');
            }
        <?php } else { ?>
            alert('Please login first!');
            document.getElementById("loginModal").style.display = "block";
        <?php } ?>
    }
</script>

</html>