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
        <div class="mainContent dashb">
            <div class="addBtn">
                <h1>Dashboard</h1>
            </div>

            <div class="items">
                <?php
                    $revenue = "SELECT SUM(total) AS Total FROM `orders`";
                    $result=mysqli_query($conn,$revenue);
                    $row=mysqli_fetch_assoc($result);
                    $total=$row['Total'];
                ?>
                <div class="item1">
                    <div class="iconBox">
                        <img src="../images/rupee.png" alt="">
                    </div>
                    <div class="content">
                        <h3>&#8377; <?php echo $total; ?>,000</h3>
                        <h5>Revenue</h5>
                    </div>
                </div>

                <?php
                    $order = "SELECT * FROM `orders`";
                    $result2 = mysqli_query($conn, $order);
                    $count = mysqli_num_rows($result2);
                ?>
                <div class="item1">
                    <div class="iconBox" style="background: #74daec;">
                        <img src="../images/shopping-bag.png" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $count; ?></h3>
                        <h5>Total Orders</h5>
                    </div>
                </div>

                <?php
                    $arts = "SELECT * FROM `customer`";
                    $result3 = mysqli_query($conn, $arts);
                    $count2 = mysqli_num_rows($result3);
                ?>
                <div class="item1">
                    <div class="iconBox" style="background: #e45d99;">
                        <img src="../images/customer.png" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $count2; ?></h3>
                        <h5>Customers</h5>
                    </div>
                </div>
            </div>

            <div class="board">
                <div class="recentOrders">
                    <div class="boardhead">
                        <h4>Recent Orders</h4>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Art Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM `orders`";
                            $check = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($check) > 0){
                                while($fetch = mysqli_fetch_assoc($check)){
                                
                        ?>
                        <tbody>
                            <tr>
                                <td><img src="../images/<?php echo $fetch['image'];?>" alt=""></td>
                                <td><?php echo $fetch['artName'];?></td>
                                <td><?php echo $fetch['price'];?></td>
                                <td><?php echo date('M j Y', strtotime($fetch['o_date']));?></td>
                                <td style="color:
                                            <?php 
                                                if($fetch['status'] == 'Pending'){ 
                                                    echo 'firebrick'; 
                                                }
                                                elseif($fetch['status'] == 'Dispatched'){
                                                    echo '#daa520';
                                                }
                                                elseif($fetch['status'] == 'Delivered'){ 
                                                    echo 'forestgreen'; 
                                                }
                                                else{
                                                    echo 'black';
                                                };  
                                            ?>; font-weight: 500;">
                                            <?php echo $fetch['status'];?>
                                </td>
                            </tr>
                        </tbody>
                        <?php    
                                }
                            }
                        ?>
                    </table>
                </div>

                <div class="recentUsers">
                    <div class="head">
                        <h4>Recent Customers</h4>
                    </div>
                    <table>
                        <tbody>
                            <?php
                                $customer = "SELECT * FROM `customer`";
                                $check2 = mysqli_query($conn, $customer);
                                if(mysqli_num_rows($check2) > 0){
                                    while($fetch2 = mysqli_fetch_assoc($check2)){
                                            
                            ?>
                            <tr>
                                <td><img src="../images/user2.png" alt=""></td>
                                <td>
                                    <h4><?php echo $fetch2['firstName'];?> <?php echo $fetch2['lastName'];?><br>
                                    <span><?php echo $fetch2['state'];?></span></h4>
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
    </div>
</body>
</html>