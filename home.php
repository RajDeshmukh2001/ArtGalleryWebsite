<?php require('Admin/connection.php'); ?>
<?php include('navbar.php'); ?>

    <!-- Home Section -->
    <div class="container">
        <div class="img"><img src="background.jpg" alt="image"></div>
        <div class="content">
            <div class="textBox">
                <p>Art is not what you see,
                    <br>
                    but what you make others see.</p>
                <span class="quote">- Edgar Degas</span>
                <div class="heading">With your continued support and art patronage we hope to make available handpicked Indian talent from across the country exclusively for you. <br>
                With a fresh rebranded look, our gallery's vision is to encourage young Indian artists as well as to ensure that you as a collector get the best of Indian Art to enjoy in your personal spaces.</div>
                <a href="#AboutUs">Read More</a>
            </div>
            <div class="Imageslider">
                <img name="slide">
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="gallery" id="Gallery">
        <h2>Art Gallery</h2>
        <hr>
        <div class="galleryBox">
            <?php
                if(isset($_SESSION['buy'])){
                    foreach($_SESSION['buy'] as $key => $value){
                        $an = $value['Name'];
                    }
                }
            ?>

            <?php
                $query = "SELECT * FROM `arts`";
                $result = mysqli_query($conn, $query);

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $artImage = $row['image'];
                        $artName = $row['name'];
                        $artistName = $row['artist'];
                        $tecnique = $row['tecnique'];
                        $price = $row['price'];
                        $dimension = $row['dimension'];

            ?>
            <form action="buyNow.php" method="POST">
                <div class="mainBox">
                    <div class="imgBox">
                        <img src="images/<?php echo $artImage; ?>" alt="image">
                        <input type="hidden" name="artimg" value="<?php echo $artImage; ?>">
                        <div class="about">
                            <div class="price">&#8377; <?php echo number_format($price); ?></div>
                            <input type="hidden" name="artPrice" value="<?php echo number_format($price); ?>">
                            <div class="dim"><?php echo $dimension; ?></div>
                            <input type="hidden" name="artDim" value="<?php echo $dimension; ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="info">
                        <div class="name"><?php echo $artName; ?></div>
                        <input type="hidden" name="art-name" value="<?php echo $artName; ?>">
                        <div class="artistName">by -<?php echo $artistName; ?></div>
                        <div class="tech">Technique - <?php echo $tecnique; ?></div>
                    </div>
                    <div class="buyBtn">
                        <button type="submit" name="buyArt" class="btn" value="buyArt">Buy Now</button>
                        <input type="hidden" name="change" value="<?php echo $an; ?>">
                    </div>
                </div>
            </form>

            <?php   
                    }
                }
            ?>

        </div>
    </div>

    <!-- Artists Section -->
    <div class="artists" id="Artists">
        <h2>Artists</h2>
        <hr>
        <div class="mainBox2 slider">

            <?php
                $query2 = "SELECT * FROM `artists`";
                $result2 = mysqli_query($conn, $query2);

                if($result2){
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $artistImage = $row2['image'];
                        $artistName2 = $row2['name'];
                        $city = $row2['city'];
                        $description = $row2['description'];
                    
            ?>

            <div class="artistBox">
                <div class="artistProfile">
                    <div class="artistImg">
                        <img src="images/<?php echo $artistImage; ?>" alt="image">
                    </div>
                    <div class="artistName">
                        <p><?php echo $artistName2; ?></p>
                        <span class="from"><?php echo $city; ?></span>
                    </div>
                </div>
                <div class="artistDetails">
                    <p class="details"><?php echo $description; ?></p>
                </div>
            </div>

            <?php
                    }
                }
            ?>

        </div>
    </div>

    <!-- About Section -->
    <br>
    <div class="aboutUs" id="AboutUs">
        <h2>About Us</h2>
        <hr>
        <div class="aboutContent">
            <div class="aboutContainer">
                <div class="aboutBox1">
                    <p><strong>Indian Art</strong> is an online gallery for contemporary art that allows collectors and art lovers alike to buy original works of art in complete security from nationally recognized artists. <strong>Indian Art</strong> is also helping emerging artists from around the globe to sell their works to art lovers. Why buy photographs or paintings online? Because we carefully select artists from around the world using our rigorous guidelines: number of exhibitions, artist residencies, awards and inclusion in public and private collections. We make the whole experience easy by taking care of the delivery, the customs and the framing of the work.
                    <br><br>    
                    <strong>Indian Art</strong> believes that the digital world is an incredible tool for buying art, spreading art around the world and allowing people to purchase pieces that they love, whether it is by a rising star of street art.</p>
                </div>
                <div class="aboutBox2">
                    <div class="feature">
                        <img src="images/free-shipping.png" alt="">
                        <h5>Free <br> Shipping</h5>
                    </div>
                    <div class="feature">
                        <img src="images/license.png" alt="">
                        <h5>Licensed <br> Art Prints</h5>
                    </div>
                    <div class="feature">
                        <img src="images/payment-method.png" alt="">
                        <h5>Cash on Delivery</h5>
                    </div>
                    <div class="feature">
                        <img src="images/credit-card.png" alt="">
                        <h5>Secure Payments</h5>
                    </div>
                </div>
                <div class="verticalText">
                    <p>T&C Apply*</p>
                </div>
            </div>

            <div class="aboutContainer2">
                <div class="line">
                    <img src="https://d17h7hjnfv5s46.cloudfront.net/assets/build/images/logos/a-world-of-creativity.e53ab93c.svg" width="260" height="52" alt="A world of creativity" lang="en">
                </div>
                <div class="links">
                    <h3>Follow Us</h3>
                    <img src="images/instagram.png" alt="" >
                    <img src="images/twitter.png" alt="" class="twitter">
                    <img src="images/whatsapp.png" alt="" class="whatsapp">
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <h4>Copyright &copy;2022 @IndianArts.Com | All Rights Reserved</h4>
    </footer>

    <!-- JavaScript -->
    <script src="script.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                    }
                }
            ]
        });
    </script>

</body>
</html>