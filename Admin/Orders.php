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
                <h1>Manage Orders</h1>
            </div>

            <div class="adminTable orderTable">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM `orders` JOIN `customer` ON orders.user=customer.u_id ORDER BY `orders`.`o_id`";
                        $result = mysqli_query($conn, $sql);
                                
                        if (mysqli_num_rows($result) > 0) 
                        {
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                    ?>
                        <tr>
                            <td><?php echo $row['o_id']; ?></td>
                            <td><?php echo $row['payment']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td style="color:
                                        <?php 
                                            if($row['status'] == 'Pending'){ 
                                                echo 'firebrick'; 
                                            }
                                            elseif($row['status'] == 'Dispatched'){
                                                echo '#daa520';
                                            }
                                            elseif($row['status'] == 'Delivered'){ 
                                                echo 'forestgreen'; 
                                            }
                                            else{
                                                echo 'black';
                                            };  
                                        ?>; font-weight: 500;">
                                        <?php echo $row['status']; ?>
                            </td>
                            <td><?php echo date('M j Y', strtotime($row['o_date'])); ?></td>
                            <td class="buttons">
                                <a href="updateOrder.php?o_id=<?php echo $row['o_id']; ?>">Update</a>
                                <a href="view.php?o_id=<?php echo $row['o_id']; ?>&c_id=<?php echo $row["c_id"] ?>" class="view">View</a>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>