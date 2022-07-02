<?php require('Admin/connection.php'); ?>
<?php include('navbar.php'); ?>

<div class="orderBox">
<?php
	$id = $_SESSION['user'];

	$sql = "SELECT * FROM `orders`, `customer` WHERE `user`='$id' AND `u_id`='$id'";
	$result = mysqli_query($conn, $sql);
			  
	if (mysqli_num_rows($result) > 0) 
    {
	    while($row = mysqli_fetch_assoc($result)) 
        {
?>
    <div class="my_Orders">
        <table>
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['o_id']; ?></td>
                    <td><?php echo $row['payment']; ?></td>
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
                    <td>
                        <a href="viewOrder.php?Order_id=<?php echo $row['o_id']; ?>&c_id=<?php echo $row['c_id']; ?>" name="view" class="view">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
        }
    }
    else
    {
        echo "
            <div class='myOrder'>
                <img src='images/box.png'>
                <h3>Sorry! No Orders Found</h3>
            </div>
        ";
    }
    ?>
</div>
            
</body>
</html>