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
                    $name = $_POST['artistname'];
                    $city = $_POST['city'];
                    $description = $_POST['description'];

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
                    $edit_artists = "UPDATE `artists` SET `image`='$image',`name`='$name',`city`='$city',`description`='$description' WHERE `artist_id`='$id'";
                    $result = mysqli_query($conn, $edit_artists);

                    if($result){
                        echo "
                            <script>alert('Record Updated Successfully');
                                window.location.href='artists.php';
                            </script>
                        ";
                    }
                    else{
                        echo "
                            <script>alert('Error!Failed to Update Record');
                                window.location.href='artists.php';
                            </script>
                        ";
                    }
                }

                if(isset($_GET['artist_id'])){
                    $artistId = $_GET['artist_id'];
                    $query = "SELECT * FROM `artists` WHERE `artist_id`='$artistId'";
                    $result2 = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result2) > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            $aId = $row['artist_id'];
                            $artistImage = $row['image'];
                            $artistName = $row['name'];
                            $artistCity = $row['city'];
                            $artistDesc = $row['description'];
                        }
            ?>

            <div class="addContent addartists">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Artists</legend>
                        <label for="img">Enter Image : </label>
                        <input class="artFile" type="file" name="img" value="<?php echo $artistImage; ?>">
                        <br>
                        <label for="artistname">Enter Artist Name : </label>
                        <input type="text" name="artistname" value="<?php echo $artistName; ?>">
                        <br>
                        <label for="city">Enter City : </label>
                        <input class="acity" type="text" name="city" value="<?php echo $artistCity; ?>">
                        <br><br>
                        <label class="artistdesc" for="desc">Enter Description : </label>
                        <textarea class="adesc" name="description" cols="60" rows="4" value="<?php echo $artistDesc; ?>"></textarea>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $aId; ?>">
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