<?php require('connection.php'); ?>
<?php require('navbar.php'); ?>

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

            <?php
                if(isset($_POST['edit'])){
                    $id = $_POST['id'];
                    $art_name = $_POST['artname'];
                    $artist = $_POST['artistname'];
                    $tech = $_POST['tecnique'];
                    $artPrice = $_POST['price'];
                    $dim = $_POST['dimension'];

                    if(isset($_FILES['img']['name'])){
                        $image = $_FILES['img']['name'];
                        $source = $_FILES['img']['tmp_name'];
                        $destination = '../images/'.$image;
                        $upload = move_uploaded_file($source, $destination);
        
                        if($upload == false){
                            echo "
                                <script>
                                    alert('Error!');
                                </script>
                            ";
        
                            die();
                        }
                    }
                    else{
                        $image = "";
                    }

                    // Update Query
                    $edit_arts = "UPDATE `arts` SET `image`='$image',`name`='$art_name',`artist`='$artist',`tecnique`='$tech',`price`='$artPrice',`dimension`='$dim' WHERE `art_id`='$id'";
                    $result = mysqli_query($conn, $edit_arts);

                    if($result){
                        echo "
                            <script>alert('Record Updated Successfully');
                                window.location.href='arts.php';
                            </script>
                        ";
                    }
                    else{
                        echo "
                            <script>alert('Error!Failed to Update Record');
                                window.location.href='arts.php';
                            </script>
                        ";
                    }
                }

                if(isset($_GET['art_id'])){
                    $art_id = $_GET['art_id'];
                    $query = "SELECT * FROM `arts` WHERE `art_id`='$art_id'";
                    $result2 = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result2) > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            $artId = $row['art_id'];
                            $artImage = $row['image'];
                            $artName = $row['name'];
                            $artistName = $row['artist'];
                            $technique = $row['tecnique'];
                            $price = $row['price'];
                            $dimensions = $row['dimension'];
                        }
            ?>

            <div class="addContent addarts">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Arts</legend>
                        <label for="img">Enter Image : </label>
                        <input class="artFile" type="file" name="img" value="<?php echo $artImage; ?>">
                        <br>
                        <label for="artname">Enter Art Name : </label>
                        <input class="artName" type="text" name="artname" value="<?php echo $artName; ?>">
                        <br>
                        <label for="artistname">Enter Artist Name : </label>
                        <input type="text" name="artistname" value="<?php echo $artistName; ?>">
                        <br>
                        <label for="tecnique">Enter Technique : </label>
                        <input class="artTec" type="text" name="tecnique" value="<?php echo $technique; ?>">
                        <br>
                        <label for="price">Enter Price : </label>
                        <input class="artPrice" type="text" name="price" value="<?php echo $price; ?>">
                        <br>
                        <label for="dimension">Enter Dimensions : </label>
                        <input type="text" name="dimension" value="<?php echo $dimensions; ?>">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $artId; ?>">
                        <button type="submit" name="edit">EDIT</button>
                        <button type="reset">RESET</button>
                    </fieldset>
                </form>
            </div>

            <?php            
                    }
                }
            ?>

        </div>
    </div>
</body>
</html>