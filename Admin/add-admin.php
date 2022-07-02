<?php require('connection.php'); ?>
<?php require('navbar.php'); ?>

    <!-- Main Body -->
    <div class="container">
        <!-- Leftside Navbar -->
        <div class="leftNavbar">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="arts.php">Arts</a></li>
                <li><a href="artists.php">Artists</a></li>
                <li><a href="admins.php">Admins</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="Orders.php">Orders</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="mainContent">
            <div class="addContent">
                <form action="" method="post">
                    <fieldset>
                        <legend>Admin Registration</legend>
                        <label for="name">Enter a Name : </label>
                        <input type="text" name="fullname">
                        <br>
                        <label for="username">Enter a Username : </label>
                        <input type="text" name="username">
                        <br>
                        <label for="email">Enter Email : </label>
                        <input type="email" name="email">
                        <br>
                        <label for="password">Enter a Password : </label>
                        <input type="password" name="password">
                        <br>
                        <button type="submit" name="add">ADD</button>
                        <button type="reset">RESET</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['add'])){
            $user_exist = "SELECT * FROM `addadmin` WHERE `username`='$_POST[username]'";
            $result = mysqli_query($conn, $user_exist);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $result_fetch = mysqli_fetch_assoc($result);
                    if ($result_fetch['username'] == $_POST['username']) 
                    {
                        echo "
                            <script>
                                alert('$result_fetch[username] - Username already exist');
                            </script>
                        ";
                    }
                }
                else{
                    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                    $insert_query = "INSERT INTO `addadmin`(`fullname`, `username`, `email`, `password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";

                    if(mysqli_query($conn, $insert_query)){
                        echo "
                            <script>alert('Admin Added Successfully!');
                                window.location.href='admins.php';
                            </script>
                        ";
                    }
                    else
                    {
                        echo "
                            <script>
                                alert('Error! Failed to Add Admin');
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

</body>
</html>