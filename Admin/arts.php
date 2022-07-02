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
                <h1>Manage Arts</h1>
                <a href="add-arts.php">Add Arts</a>
            </div>

            <div class="adminTable artsTable">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th class="srno">Sr No</th>
                            <th>Image</th>
                            <th>Art Name</th>
                            <th>Artist</th>
                            <th>Price(&#8377;)</th>
                            <th>Technique</th>
                            <th>Dimension</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php
                        $sr = 1;
                        $query = "SELECT * FROM `arts`";
                        $result = mysqli_query($conn, $query);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $image = $row['image'];
                    ?>
                    <tbody>
                        <tr>
                            <td class="srno"><?php echo $sr++; ?></td>
                            <td>
                                <?php
                                    if($image != ""){
                                ?>
                                <img src="../images/<?php echo $image; ?>" alt="Image">
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['artist']; ?></td>
                            <td><?php echo number_format($row['price']); ?></td>
                            <td><?php echo $row['tecnique']; ?></td>
                            <td><?php echo $row['dimension']; ?></td>
                            <td class="buttons">
                                <a href="edit-arts.php?art_id=<?php echo $row['art_id']; ?>">Edit</a>
                                <a href="delete.php?art_id=<?php echo $row['art_id']; ?>" class="deleteBtn">Delete</a>
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