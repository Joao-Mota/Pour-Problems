<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="script" href="../javascript/script.js">
        <link rel="stylesheet" href="../css/login.css">
        <title>PourProblems</title>
    </head>
    <body>
        <header>
            <h1>PourProblems</h1>
            
            <!-- Navigation Bar -->
            <div class="navbar">
                <a href="index.php">Home</a>
                <a href="aboutUs.php">About Us</a>
                <a href="tickets.php">Tickets</a>
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
                <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>

                <div id="id01" class="modal1">
                    <form class="modal-content animate" action="/action_page.php" method="post">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <img src="sources/icon.png" alt="Avatar" class="avatar">
                        </div>

                        <div class="container">
                            <label for="uname"><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="uname" required>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                                
                            <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>

                        <div class="container" style="background-color:#f1f1f1">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            <span class="psw">Forgot <a href="#">password?</a></span>
                        </div>
                    </form>
                </div>

                <div id="id02" class="modal2">
                <form class="modal-content animate" action="/action_page.php" method="post">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <img src="sources/icon.png" alt="Avatar" class="avatar">
                        </div>

                        <div class="container">
                            <label for="uname"><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="uname" required>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                                
                            <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>

                        <div class="container" style="background-color:#f1f1f1">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                            <span class="psw">Forgot <a href="#">password?</a></span>
                        </div>
                    </form>
                </div>
                </div>
                
                <!-- If the user is logged in, display the logout button and my tickets -->
                
                <?php
                    session_start();
                    if(isset($_SESSION['username'])) {
                        echo "<a href='profile.php>Profile</a>";
                        echo "<a href='myTickets.php'>My Tickets</a>";
                        echo "<a href='logout.php'>Logout</a>";
                    }
                ?>
                
            </div>


        </header>

        <div id = "aboutUs">
            <h1>About Us</h1>
            <p>Our team is made up of 4 students from the University of Pittsburgh. We are all seniors in the Computer Science program. We are all from the Pittsburgh area and have been friends since high school. We all have a passion for computer science and are excited to be working on this project together.</p>
        </div>
        <div id = "FAQ">

            <table>

                <tr>
                    <h2> FAQ </h2>
                </tr>
                <tr>
                    <h3> What is PourProblems? </h3>
                    <p> PourProblems is a website that allows users to search for and review bars in the Pittsburgh area. </p>
                </tr>
                <tr>    
                    <h3> How do I use PourProblems? </h3>
                    <p> To use PourProblems, you must first create an account. Once you have created an account, you can search for bars in the Pittsburgh area. You can also review bars that you have been to. </p>
                </tr>
                <tr>    
                    <h3> How do I create an account? </h3>
                    <p> To create an account, click the "Sign Up" button on the login page. </p>
                </tr>
                <tr>    
                    <h3> How do I search for a bar? </h3>
                    <p> To search for a bar, click the "Search" button on the navigation bar. You can then search for a bar by name, location, or rating. </p>
                </tr>
                <tr>    
                    <h3> How do I review a bar? </h3>
                    <p> To review a bar, click the "Review" button on the navigation bar. You can then search for a bar by name, location, or rating. Once you have found the bar you want to review, click the "Review" button next to the bar. You can then rate the bar and leave a comment. </p>
                </tr>
                <tr>    
                    <h3> How do I view my profile? </h3>
                    <p> To view your profile, click the "Profile" button on the navigation bar. </p>
                </tr>

            </table>

        </div>

        <footer>

            <!-- Footer with 3 collums, collum 1 is Support with contacts, second collum is Social media and third collum is logo with copyright symbol -->
            <div class="footer">
                <div class="footer-support">
                    <h1>Support</h1>
                    <p>Support Phone Number: 412-123-4567</p>
                    <p>Support Email: support@pourproblems.com</p>
                </div>
                <div class="footer-social">
                    <h1>Social Media</h1>
                    <p>Instagram: @pourproblems</p>
                    <p>Twitter: @pourproblems</p>
                    <p>Facebook: PourProblems</p>
                </div>
                <div class="footer-logo">
                    <img src="../sources/icon.png" alt="PourProblems Logo" width="100" height="100">
                    <p>&copy; 2021 PourProblems</p>
                </div>
            </div>

        </footer>

    </body>        
</html>