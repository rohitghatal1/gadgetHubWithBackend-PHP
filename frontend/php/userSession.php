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
                <div class="avatar mb-3 bg-danger p-1 px-1 me-3 text-center rounded-circle" onclick="toggleDropdown(event);" style="width:2rem;height:2rem">$firstLetterAvatar</div>

                <div class="dropdown-container bg-dark p-3 px-5 me-2 rounded z-3" id="droppedDownContent" style="position:absolute; right:5px; display:none">
                    <h3 class="heading-font text-center">$firstLetterAvatar</h3>
                    <p class="text-font">$username</p>
                    <p class="text-font myBooking text-center"><a href="userPage.php?userId={$uid}" class="text-decoration-none">My cart</a></p>
                    <a id = "logout"href="../backend/logout.php" class="text-font text-center ms-3 text-decoration-none">Log out</a>
                </div>
            </div>
        dropdown;
}
?>