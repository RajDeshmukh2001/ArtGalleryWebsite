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
            <div class="adminTable viewTable">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Art Name</th>
                            <th>Dimensions</th>
                            <th>Price</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <?php
                        $o_id = $_GET['o_id'];
                        $c_id = $_GET['c_id'];
                        $sql = "SELECT * FROM `orders`, `customer` WHERE `o_id`='$o_id' AND `c_id`='$c_id'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                    ?>
                    <tbody>
                        <tr>
                            <td><img src="../images/<?php echo $row['image']; ?>" alt=""></td>
                            <td><?php echo $row['artName']; ?></td>
                            <td><?php echo $row['dimensions']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td>
                                <?php echo $row['address1']; ?>, <?php echo $row['address2']; ?> - <?php echo $row['pin']; ?>, <?php echo $row['state']; ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>