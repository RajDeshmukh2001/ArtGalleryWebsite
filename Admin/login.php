<?php require('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="index.css">

    <style>
        body{
            background-color: #ebebeb;
        }
    </style>
</head>
<body>
    <div class="adminLoginForm">
        <div class="myForm">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h2>ADMIN LOGIN</h2>
                <input type="text" name="username" placeholder="Enter a Username">
                <input type="password" name="password" placeholder="Enter a Password">
                <button type="submit" name="login">LOGIN</button>
            </form>
        </div>

        <div class="img">
            <img src="../images/Manwithvoilen.jpg" alt="image" width="300px">
        </div>
    </div>

    <?php
        if(isset($_POST['login'])){
            $query = "SELECT * FROM `addadmin` WHERE `username`='$_POST[username]'";
            $result = mysqli_query($conn, $query);

            if($result){
                if(mysqli_num_rows($result) == 1){
                    $result_fetch = mysqli_fetch_assoc($result);

                    if(password_verify($_POST['password'], $result_fetch['password'])){
                        echo "
                            <script>
                                alert('Admin Logged in Successfully');
                            </script>
                        ";

                        session_start();
                        $_SESSION['AdminLogin'] = $_POST['username'];
                        header("location:index.php");
                    }
                    else{
                        echo "
                            <script>
                                alert('Error! Incorrect Password');
                            </script>
                        ";
                    }
                   
                }
                else{
                    echo "
                        <script>
                            alert('Error! Invalid Username');
                        </script>
                    ";
                }
            }
            else{
                echo "
                    <script>
                        alert('Cannot run');
                    </script>
                ";
            }
        }
    ?>
</body>
</html>