<?php
    require('connection.php');

    // Delete Arts
    if(isset($_GET['art_id'])){
        $art_id = $_GET['art_id'];

        $delete_art = "DELETE FROM `arts` WHERE `art_id` = '$art_id'";
        $result = mysqli_query($conn, $delete_art);

        if($result){
            echo "
                <script>alert('Record Deleted Successfully');
                    window.location.href='arts.php';
                </script>
            ";
        }
        else{
            echo "
                <script>
                    alert('Error!Failed to Delete Record');
                    window.location.href='arts.php';
                </script>
            ";
        }
    }

    // Delete Artists
    if(isset($_GET['artist_id'])){
        $artist_id = $_GET['artist_id'];

        $delete_artist = "DELETE FROM `artists` WHERE `artist_id` = '$artist_id'";
        $result2 = mysqli_query($conn, $delete_artist);

        if($result2){
            echo "
                <script>alert('Record Deleted Successfully');
                    window.location.href='artists.php';
                </script>
            ";
        }
        else{
            echo "
                <script>alert('Error!Failed to Delete Record');
                    window.location.href='artists.php';
                </script>
            ";
        }
    }

    // Delete Admins
    if(isset($_GET['admin_id'])){
        $admin_id = $_GET['admin_id'];

        $delete_admin = "DELETE FROM `addadmin` WHERE `admin_id` = '$admin_id'";
        $result3 = mysqli_query($conn, $delete_admin);

        if($result3){
            echo "
                <script>alert('Record Deleted Successfully');
                    window.location.href='admins.php';
                </script>
            ";
        }
        else{
            echo "
                <script>
                    alert('Error!Failed to Delete Record');
                </script>
            ";
        }
    }

    // Delete Users
?>