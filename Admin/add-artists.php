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
            <div class="addContent addartists">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Add Artists</legend>
                        <label for="img">Enter Image : </label>
                        <input class="artFile" type="file" name="img">
                        <br>
                        <label for="artistname">Enter Artist Name : </label>
                        <input type="text" name="artistname">
                        <br>
                        <label for="city">Enter City : </label>
                        <input class="acity" type="text" name="city">
                        <br><br>
                        <label class="artistdesc" for="desc">Enter Description : </label>
                        <textarea class="adesc" name="description" cols="60" rows="4"></textarea>
                        <br>
                        <button type="submit" name="add">ADD</button>
                        <button type="reset">RESET</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['add'])){
            $artistName = $_POST['artistname'];
            $city = $_POST['city'];
            $description = $_POST['description'];

            if(isset($_FILES['img']['name'])){
                $imageName = $_FILES['img']['name'];
                $source = $_FILES['img']['tmp_name'];
                $destination = '../images/'.$imageName;
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
                $imageName = "";
            }

            $query = "INSERT INTO `artists`(`image`, `name`, `city`, `description`) VALUES ('$imageName','$artistName','$city','$description')";
            $result = mysqli_query($conn, $query);

            if($result){
                echo "
                    <script>alert('Art Added Successfully');
                        window.location.href='artists.php';
                    </script>
                ";
            }
            else{
                echo "
                    <script>alert('Error! Failed to Add Artists');
                        window.location.href='artists.php';
                    </script>
                ";
            }
        }
    ?>
</body>
</html>

