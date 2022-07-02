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
            <div class="addContent addarts">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Add Arts</legend>
                        <label for="img">Enter Image : </label>
                        <input class="artFile" type="file" name="img">
                        <br>
                        <label for="artname">Enter Art Name : </label>
                        <input class="artName" type="text" name="artname">
                        <br>
                        <label for="artistname">Enter Artist Name : </label>
                        <input type="text" name="artistname">
                        <br>
                        <label for="tecnique">Enter Technique : </label>
                        <input class="artTec" type="text" name="tecnique">
                        <br>
                        <label for="price">Enter Price : </label>
                        <input class="artPrice" type="text" name="price">
                        <br>
                        <label for="dimension">Enter Dimensions : </label>
                        <input type="text" name="dimension">
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
            $artName = $_POST['artname'];
            $artistName = $_POST['artistname'];
            $tecnique = $_POST['tecnique'];
            $price = $_POST['price'];
            $dimension = $_POST['dimension'];

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

            $query = "INSERT INTO `arts`(`image`, `name`, `artist`, `tecnique`, `price`, `dimension`) VALUES ('$imageName', '$artName', '$artistName', '$tecnique', '$price', '$dimension')";
            $result = mysqli_query($conn, $query);

            if($result){
                echo "
                    <script>alert('Art Added Successfully');
                        window.location.href='arts.php';
                    </script>
                ";
            }
            else{
                echo " 
                    <script>alert('Error! Failed to Add Art');
                        window.location.href='arts.php';
                    </script>
                ";
            }
        }
    ?>
</body>
</html>