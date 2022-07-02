<?php require('connection.php'); ?>
<?php include('navbar.php'); ?>

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

        <?php
            $o_id = $_GET['o_id'];

            if (isset($_POST['update'])) 
            {
                $status = $_POST['status'];

                $sql = "SELECT * FROM `orders` WHERE `o_id`='$o_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                if (mysqli_num_rows($result) == 1)
                {
                    $update = "UPDATE `orders` SET `status`='$status' WHERE `o_id`='$o_id'";
                    if(mysqli_query($conn, $update)){
                        echo "
                            <script>alert('Updated');
                                window.location.href='Orders.php';
                            </script>
                        ";
                    }
                }
            }
        ?>

        <div class="mainContent">
            <div class="updateStatus">
                <fieldset>
                    <legend>Update Order Status</legend>
                    <form action="" method="POST">
                        <select name="status" class="status" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Dispatched">Dispatched</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                        <br>
                        <input type="submit" name="update" value="Update">
                    </form>
                </fieldset>
            </div>
        </div>
    </div>