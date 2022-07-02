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

        <!-- Main Content -->
        <div class="mainContent">
            <div class="addBtn">
                <h1>Users</h1>
            </div>

            <div class="adminTable userTable">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <?php
                        $sr = 1;
                        $query = "SELECT * FROM `users`";
                        $result = mysqli_query($conn, $query);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $sr++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                    </tbody>

                    <?php
                                }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>