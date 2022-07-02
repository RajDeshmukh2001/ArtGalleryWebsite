<?php require('Admin/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Arts</title>

    <link rel="stylesheet" href="style.css">

    <!-- Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navbar Section -->
    <div class="header">
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Indian Arts Logo">
            </div>
            <div class="nav">
                <div class="nav">
                    <a href="home.php">HOME</a>
                    <a href="#Gallery">GALLERY</a>
                    <a href="#Artists">ARTIST</a>
                    <a href="#AboutUs">ABOUT</a>
                    <?php
                        session_start();
                        if(isset($_SESSION['UserLoggedIn']) && $_SESSION['UserLoggedIn']==true){
                            echo "
                                <a href='#' onclick='menuToggle();'>PROFILE</a>
                                <div class='menu'>
                                    <ul>
                                        <li>
                                            <img src='images/User.png' alt='User'>
                                            <a href='' class='userimg'>".$_SESSION['UserLoggedIn']."</a>
                                        </li>
                                        <li>
                                            <img src='images/order.png' alt='Error'>
                                            <a href='myOrder.php'>My Orders</a>
                                        </li>
                                        <form method='post'>
                                            <li>
                                                <img src='images/logout.png' alt='Error'>
                                                <input type='submit' name='Logout' value='Logout'>
                                            </li>
                                        </form>
                                    </ul>
                                </div>
                            ";
                        }
                        else{
                            echo "<a href='#login' class='login' id='login'>LOGIN</a>";
                        }

                        if(isset($_POST['Logout'])){
                            session_destroy();
                            header('location:home.php');
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Login section -->
    <div class="popup-container">
        <div class="popup">
            <form action="userlogin.php" method="POST">
                <h2>
                    <span>User Login</span>
                    <button type="reset" class="close">X</button>
                </h2>
                <input type="text"     name="Username" placeholder="Enter Username">
                <input type="password" name="Password" placeholder="Enter a Password">
                <button type="submit" class="login-btn" name="login">Login</button>
            </form>
            <p>Don't have an account? Create <a href="#register" class="register" id="register">One</a></p>
        </div>
    </div>

    <!-- Register Section -->
    <div class="popup-register">
        <div class="popup">
            <form action="" method="POST">
                <h2>
                    <span>User Registration</span>
                    <button type="reset" class="close2">X</button>
                </h2>
                <input type="text"     name="Username" placeholder="Enter Username">
                <input type="email"    name="email"    placeholder="Enter your email">
                <input type="password" name="Password" placeholder="Create a Password">
                <button type="submit"  class="register-btn" name="user-register">SignUp</button>
            </form>
            <p>Already have an account? 
                Click <a href="#login" class="login2" id="login2">Here</a>
            </p>
        </div>
    </div>

    <!-- PHP script for User Registration -->
    <?php
        if(isset($_POST['user-register'])){
            $query = "SELECT * FROM `users` WHERE `username` = '$_POST[Username]'";
            $result = mysqli_query($conn, $query);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $result_fetch = mysqli_fetch_assoc($result);
                    if($result_fetch['username'] == $_POST['Username']){
                        echo "
                            <script>
                                alert('$result_fetch[username] - Username already taken');
                            </script>
                        ";
                    }
                }
                else{
                    $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
                    $insert = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$_POST[Username]','$_POST[email]','$password')";

                    if(mysqli_query($conn, $insert)){
                        echo "
                            <script>alert('Registration Successfull!');
                                window.location.href='home.php';
                            </script>
                        ";
                    }
                    else{
                        echo "
                            <script>
                                alert('Error! Registration Unsuccessfull');
                            </script>
                        ";
                    }
                }
            }
            else{
                echo "
                    <script>
                        alert('Error...');
                    </script>
                ";
            }
        }
    ?>    

    <!-- Javascript -->
    <script>
        document.getElementById('login').addEventListener('click', () => {
            document.querySelector('.popup-container').style.display = 'flex';  
        })
        document.querySelector('.close').addEventListener('click', ()=>{
            document.querySelector('.popup-container').style.display = 'none';  
        })

        document.getElementById('register').addEventListener('click', ()=>{
            document.querySelector('.popup-register').style.display = 'flex';
            document.querySelector('.popup-container').style.display = 'none';
        })
        document.querySelector('.close2').addEventListener('click', ()=>{
            document.querySelector('.popup-register').style.display = 'none';
        })

        document.getElementById('login2').addEventListener('click', () => {
            document.querySelector('.popup-container').style.display = 'flex';
            document.querySelector('.popup-register').style.display = 'none';  
        })
    </script>

    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
    </script>