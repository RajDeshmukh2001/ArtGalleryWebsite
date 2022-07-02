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

            <?php
                if(isset($_POST['edit'])){
                    $id = $_POST['id'];
                    $name = $_POST['fullname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

                    $edit_query = "UPDATE `addadmin` SET `fullname`='$name',`username`='$username',`email`='$email',`password`='$password' WHERE `admin_id`='$id'";
                    $result = mysqli_query($conn, $edit_query);

                    if($result){
                        echo "
                            <script>alert('Record Updated Successfully');
                                window.location.href='admins.php';
                            </script>
                        ";
                    }
                    else{
                        echo "
                            <script>alert('Error!Failed to Update Record');
                                window.location.href='admins.php';
                            </script>
                        ";
                    }
                }

                if(isset($_GET['admin_id'])){
                    $id = $_GET['admin_id'];
                    $query = "SELECT * FROM `addadmin` WHERE `admin_id`='$id'";
                    $result2 = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result2) > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            $admin_id = $row['admin_id'];
                            $admin_name = $row['fullname'];
                            $admin_un = $row['username'];
                            $admin_email = $row['email'];
                            $admin_pass = $row['password'];
                        }
            ?>

            <div class="addContent">
                <form action="" method="post">
                    <fieldset>
                        <legend>Edit Admin Information</legend>
                        <label for="name">Enter a Name : </label>
                        <input type="text" name="fullname" value="<?php echo $admin_name; ?>">
                        <br>
                        <label for="username">Enter a Username : </label>
                        <input type="text" name="username" value="<?php echo $admin_un; ?>">
                        <br>
                        <label for="email">Enter Email : </label>
                        <input type="email" name="email" value="<?php echo $admin_email; ?>">
                        <br>
                        <label for="password">Enter a Password : </label>
                        <input type="password" name="password">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $admin_id; ?>">
                        <button type="submit" name="edit">EDIT</button>
                        <button type="reset">RESET</button>
                    </fieldset>
                </form>
            </div>
            <?php
                    }
                    else{
                        header('location:admins.php');
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>