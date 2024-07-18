<?php 
session_start();
require 'database/databaseConnection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];

    $getAdminDetails ="SELECT * FROM admin_table";
    $fetchedAdminData = $conn->query($getAdminDetails);
    if($fetchedAdminData->num_rows > 0){
        while($adminData = $fetchedAdminData->fetch_assoc()){
            if($username == $adminData['adminUsername'] && $password == $adminData['adminPassword']){
                $_SESSION['adminUsername'] = $username;
                header("location: adminDashboard.php");
            }
            else {
                $errorMessage = urlencode('incorrect username or password');
                header('Location: adminLoginPage.php?loginfailed=' . $errorMessage);
                exit();
            }
            
        }
    }
}
