<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PourProblems</title>

        <!-- Swipper css link -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <!-- Font Awesome cdnjs link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Custom CSS link -->
        <link rel="stylesheet" href="../css/style.css">

    </head>
    <body>
        
        <header>
            <section class="header">

                <a href="index.php" class="logo">
                    <img src="../sources/PourProblems_Logo_Gray.png" alt="PourProblems" width="140">
                </a>

                <nav class="navbar">
                    <a href="/pages/about.php">About</a>
                    <a href="/pages/tickets.php">Tickets</a>
                    <a href="/pages/signup.php">Sign Up</a>
                    <a href="/pages/login.php">Login</a>
                </nav>

                <div id="menu-bars" class="fas fa-bars"></div>

            </section>
        </header>

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide" style="background: url(/sources/heading_bg/about-slide-bg.jpg) no-repeat;">
                        <div class="content">
                            <span>Wine Cellar</span>
                            <h3>Porto</h3>
                            <p>One of the best wine producers globally!</p>
                            <a href="/pages/about.php" class="btn">More Info</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide" style="background: url(/sources/heading_bg/tickets-slide-bg.jpg) no-repeat;">
                        <div class="content">
                            <span>Support</span>
                            <h3>Pour</h3>
                            <h3>Problems</h3>
                            <p>We answer every question you may have!</p>
                            <a href="/pages/tickets.php" class="btn">Tickets!</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide" style="background: url(/sources/heading_bg/signup-slide-bg.jpg) no-repeat;">
                        <div class="content">
                            <h3>Join us!</h3>
                            <a href="/pages/signup.php" class="btn">Sign Up!</a>
                        </div>
                    </div>

                    
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
            </div>

        </section>



        <section class="home-fqa">

        </section>

        

        <section class="home-about">

            <div class="image">
                <img src="../sources/heading_bg/home-about-us-troll.jpg" alt="">
            </div>



        </section>









    
        <footer>
            <section class="footer">

                <div class="box-conteiner">

                    <div class="box">
                        <h3>Quick Links</h3>
                        <a href="/pages/about.php"> <i class="fas fa-angle-right"></i> About</a>
                        <a href="/pages/tickets.php"> <i class="fas fa-angle-right"></i> Tickets</a>
                        <a href="/pages/signup.php"> <i class="fas fa-angle-right"></i> Sign Up</a>
                        <a href="/pages/login.php"> <i class="fas fa-angle-right"></i> Login</a>
                    </div>

                    <div class="box">
                        <h3>Extra Links</h3>
                        <a href="/pages/faq.php"> <i class="fas fa-angle-right"></i> FAQ</a>
                        <a href="/pages/pp.php"> <i class="fas fa-angle-right"></i> Privacy Policy</a>
                        <a href="/pages/tos.php"> <i class="fas fa-angle-right"></i> Terms of Service</a>
                    </div>

                    <div class="box">
                        <h3>Contact Info</h3>
                        <a href="#"> <i class="fas fa-phone"></i> +351 220 000 000</a>
                        <a href="#"> <i class="fas fa-envelope"></i> support@pourproblems.com </a>
                        <a href="#"> <i class="fas fa-map"></i> Porto, Portugal - 4200-465</a>
                    </div>

                    <div class="box">
                        <h3>Social</h3>
                        <a href="#"> <i class="fab fa-facebook-f"></i> PourProblems</a>
                        <a href="#"> <i class="fab fa-twitter"></i> @PourProblems</a>
                        <a href="#"> <i class="fab fa-instagram"></i> @PourProblems</a>
                        <a href="#"> <i class="fab fa-youtube"></i> PourProblems</a>
                        <a href="#"> <i class="fab fa-linkedin"></i> PourProblems</a>
                    </div>

                    <div class="box">
                        <img src="../sources/PourProblems_Logo_White.png" alt="PourProblems" width="150">
                    </div>

                </div>

            </section>
        </footer>

        <!-- Swipper js link -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- custom js file link -->
        <script src="../javascript/script.js"></script>

    </body>
</html>