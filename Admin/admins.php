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
                <h1>Admin</h1>
                <a href="add-admin.php">Add Admin</a>
            </div>

            <div class="adminTable adminTable2">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Admin Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php
                        $sr = 1;
                        $query = "SELECT * FROM `addadmin`";
                        $result = mysqli_query($conn, $query);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $sr++; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <a href="edit-admin.php?admin_id=<?php echo $row['admin_id']; ?>">Edit</a>
                                <a href="delete.php?admin_id=<?php echo $row['admin_id']; ?>" class="deleteBtn">Delete</a>
                            </td>
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