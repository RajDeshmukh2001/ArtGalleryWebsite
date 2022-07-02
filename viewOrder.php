<?php require('Admin/connection.php'); ?>
<?php include('navbar.php'); ?>

    <div class="my_Orders view_Orders">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Art Name</th>
                    <th>Dimension</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php
                $id = $_GET['Order_id'];
                $sql = "SELECT * FROM `orders` WHERE `o_id`='$id'";
                $result = mysqli_query($conn, $sql);
                        
                if (mysqli_num_rows($result) > 0) 
                {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
            ?>
            <tbody>
                <tr>
                    <td><img src="images/<?php echo $row['image']; ?>" alt=""></td>
                    <td><?php echo $row['artName']; ?></td>
                    <td><?php echo $row['dimensions']; ?></td>
                    <td>&#8377; <?php echo $row['price']; ?></td>
                    <td>&#8377; <?php echo $row['total']; ?></td>
                </tr>
            </tbody>
            <?php
                    }
                }
            ?>
        </table>
    </div>

    <div class="address">
        <fieldset>
            <legend>ADDRESS</legend>
            <?php
                $id2 = $_GET['c_id'];
                $sql2 = "SELECT * FROM `customer` WHERE `c_id`='$id2'";
                $result2 = mysqli_query($conn, $sql2);
                            
                $row2 = mysqli_fetch_assoc($result2);
                echo "
                    <h3>" .$row2['firstName']. " " .$row2['lastName']. "</h3>
                    <h4>" .$row2['contact']. "</h4>
                    <h4>" .$row2['address1']. ", " .$row2['address2']. " - " .$row2['pin']. "</h4>
                    <h4>" .$row2['state']. "</h4>
                ";
            ?>
        </fieldset>
    </div>
</body>
</html>