<?php require('Admin/connection.php'); ?>

<!-- PHP script for User Login -->
<?php
    if(isset($_POST['login'])){
        $login_query = "SELECT * FROM `users` WHERE `username` = '$_POST[Username]'";
        $result2 = mysqli_query($conn, $login_query);

        if($result2){
            if(mysqli_num_rows($result2) == 1){
                $result_fetch2 = mysqli_fetch_assoc($result2);
                if(password_verify($_POST['Password'], $result_fetch2['password'])){
                    echo "
                        <script>
                            alert('Login Successfull');
                            window.location.href='home.php';
                        </script>
                    ";

                    session_start();
                    $_SESSION['UserLoggedIn']=true;
                    $_SESSION['UserLoggedIn'] = $_POST['Username'];
                    $_SESSION['user'] = $result_fetch2['user_id'];
                    header('location:home.php');
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
                    alert('Error!!!');
                </script>
            ";
        }
    }
?>