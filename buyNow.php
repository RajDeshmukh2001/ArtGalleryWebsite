<?php require('Admin/connection.php'); ?>
<?php include('navbar.php'); ?>

<?php
    if (!isset($_SESSION['UserLoggedIn']) && $_SESSION['UserLoggedIn']==false)
    {
        echo "<script>alert('You need to Login First');
                window.location.href='home.php';
            </script>";
    }
?>

<?php
    if(isset($_POST['buyArt'])){
        $art_name = $_POST['art-name'];
        $art_price = $_POST['artPrice'];
        $art_dim = $_POST['artDim'];
        $art_img = $_POST['artimg'];

        if(isset($_SESSION['buy']) && count($_SESSION['buy']) == 1){
            foreach ($_SESSION['buy'] as $key => $value) 
            {
                if($value['Name'] === $_POST['change'])
                {
                    unset($_SESSION['buy'][$key]);
                    $_SESSION['buy']=array_values($_SESSION['buy']);
                    $_SESSION['buy'][] = array('Name'=>$art_name, 'Price'=>$art_price, 'Dimension'=>$art_dim, 'image'=>$art_img);
                    echo "
                        <script>
                            window.location.href='buyNow.php'; 
                        </script>
                    "; 
                }         
            } 
        }
        else{
            $_SESSION['buy'][] = array('Name'=>$art_name, 'Price'=>$art_price, 'Dimension'=>$art_dim, 'image'=>$art_img);
            echo "
                <script>
                    window.location.href='buyNow.php';
                </script>
            ";
        }
    }

    // Remove Art
    if (isset($_POST['remove'])) 
    {
        foreach ($_SESSION['buy'] as $key => $value) 
        {
            if($value['Name'] === $_POST['ArtRemove'])
            {
                unset($_SESSION['buy'][$key]);
                $_SESSION['buy']=array_values($_SESSION['buy']);
                echo "
                    <script>alert('Art removed Successfully');
                        window.location.href='home.php'; 
                    </script>
                "; 
            }         
        }
    }
?>

<div class="buyArtBox">
    <table class="artDetails">
        <thead>
            <tr>
                <th>Image</th>
                <th>Art Name</th>
                <th>Dimensions</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                if(isset($_SESSION['buy'])){
                    foreach($_SESSION['buy'] as $key => $value){
                        $total = $value['Price'];
                        $artN = $value['Name'];
                        $artI = $value['image'];
                        $artD = $value['Dimension'];
                        $artP = $value['Price'];
                        echo "
                            <form method='POST'>
                                <tr>
                                    <td><img src='images/$value[image]'></td>
                                    <td>$value[Name]</td>
                                    <td>$value[Dimension]</td>
                                    <td>&#8377; $value[Price]</td>
                                    <td>
                                        <button name='remove' class='remove'>Remove</button>
                                        <input type='hidden' name='ArtRemove' value='$value[Name]'>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan='3' class='total'>Total</th>
                                    <td class='total2'>&#8377; $total</td>
                                </tr>
                            </form>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Order Section -->
<?php
    if (isset($_POST['MakePurchase'])) 
    {
        $first=$_POST['first'];
        $last=$_POST['last'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address1=$_POST['address1'];
        $address2=$_POST['address2'];
        $pin=$_POST['pin'];
        $state=$_POST['state'];
        $payment=$_POST['pay'];
        $user_id = $_SESSION['user'];

        $sql = "SELECT * FROM `customer` WHERE `u_id`='$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $c_id = $row['c_id'];

        if (mysqli_num_rows($result) == 1) 
        {
            $update_sql = "UPDATE `customer` SET `firstName`='$first',`lastName`='$last',`email`='$email',`contact`='$contact',`address1`='$address1',`address2`='$address2',`pin`='$pin',`state`='$state' WHERE `u_id`='$user_id'";

            $updated = mysqli_query($conn, $update_sql);
            if ($updated) 
            {
                $insertOrder = "INSERT INTO `orders`(`user`, `image`, `artName`, `dimensions`, `price`, `total`, `payment`, `status`) VALUES ('$user_id','$artI','$artN','$artD','$artP','$total','$payment','Order Placed')";  

				if(mysqli_query($conn, $insertOrder))
				{
					$orderid = mysqli_insert_id($conn);
                    unset($_SESSION['buy']);
					echo "
                        <script>alert('Order Placed Successfully');
                            window.location.href='myOrder.php'; 
                        </script>
                    "; 
                }
            }
        }
        else
        {
            $insert_sql = "INSERT INTO `customer`(`u_id`, `firstName`, `lastName`, `email`, `contact`, `address1`, `address2`, `pin`, `state`) VALUES ('$user_id','$first','$last','$email','$contact','$address1','$address2','$pin','$state')";

            $inserted = mysqli_query($conn, $insert_sql);
            $c_id = mysqli_insert_id($conn);
            if ($inserted)
            {
                $insertOrder = "INSERT INTO `orders`(`user`, `image`, `artName`, `dimensions`, `price`, `total`, `payment`, `status`) VALUES ('$user_id','$artI','$artN','$artD','$artP','$total','$payment','Order Placed')";  

				if(mysqli_query($conn, $insertOrder))
				{
                    unset($_SESSION['buy']);
					echo "
                        <script>alert('Order Placed Successfully');
                            window.location.href='myOrder.php'; 
                        </script>
                    "; 
                }
            } 
        }
    }
?>

<div class="addressBox">
    <form method="POST">
        <fieldset>
            <legend>Billing Info</legend>
            <label for="fisrt">First Name : </label>
            <input type="text" name="first" required>
            <label for="last">Last Name : </label>
            <input type="text" name="last" required>
            <br>
            <label for="email">Email : </label>
            <input type="email" name="email" class="email">
            <label for="contact">Contact : </label>
            <input type="text" name="contact" class="contact" required>
            <br>
            <label for="address1">Address 1 : </label>
            <input type="text" name="address1" class="addr1" placeholder="Block No/Flat No/Building Name/etc" required>
            <br>
            <label for="address2">Address 2 : </label>
            <input type="text" name="address2" class="addr" placeholder="Street/Landmark/Town/City/etc">
            <br>
            <label for="pin">Pin Code : </label>
            <input type="text" name="pin" class="pincode">
            <label for="state">State : </label>
            <input type="text" name="state" class="state">
            <br>
            <label for="payment">Payment : </label>
            <input type="radio" name="pay" value="COD" class="pay">COD
            <input type="radio" name="pay" value="UPI">UPI
            <input type="radio" name="pay" value="CARD">Credit/Debit
            <br>
            <button type="submit" name="MakePurchase">PAY</button>
            <button type="reset">RESET</button>
        </fieldset>
    </form>
</div>

<footer class="foot">
    <h4>Copyright &copy;2022 @IndianArts.Com | All Rights Reserved</h4>
</footer>