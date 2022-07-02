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
                <h1>Manage Artists</h1>
                <a href="add-artists.php">Add Artists</a> 
            </div>

            <div class="adminTable artistTable">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th class="srno">Sr No</th>
                            <th>Image</th>
                            <th>Artist Name</th>
                            <th>City</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php
                        $sr = 1;
                        $query = "SELECT * FROM `artists`";
                        $result = mysqli_query($conn, $query);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                
                    ?>
                    <tbody>
                        <tr>
                            <td class="srno"><?php echo $sr++; ?></td>
                            <td><img src="../images/<?php echo $row['image']; ?>" alt="Image"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td class="buttons">
                                <a href="edit-artists.php?artist_id=<?php echo $row['artist_id'] ?>">Edit</a>
                                <a href="delete.php?artist_id=<?php echo $row['artist_id'] ?>" class="deleteBtn">Delete</a>
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