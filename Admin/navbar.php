<?php require('connection.php'); ?> 
<?php    
    session_start();
    if(!isset($_SESSION['AdminLogin'])){
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="index.css">
</head>
<body>
    <!-- Navbar Section -->
    <div class="navbar">
        <div class="logo">
            <img src="../images/logo.png" alt="Indian Arts Logo">
        </div>
        <div class="nav">
            <img src="../images/User.png" alt="User">
            <h4><?php echo $_SESSION['AdminLogin'] ?></h4>
        </div>
        <div class="logout">
            <form action="" method="post">
                <img src="../images/logout.png" alt="logoutBtn">
                <input type="submit" name="Logout" value="Logout">
            </form>
        </div>
    </div>

    <?php
        if(isset($_POST['Logout'])){
            session_destroy();
            header('location:login.php');
        } 
    ?>