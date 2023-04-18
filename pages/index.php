<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/login.css">
        <title>PourProblems</title>
        <link rel="script" href="../javascript/script.js">
    </head>
    <body>
        <header>

        </header>
            
        <div>
            <form action="profile.php" method="post">
                <div class="imgcontainer">
                    <img src="../sources/icon.png" alt="Avatar" class="avatar">
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
                    <button type="button" class="cancelbtn">Cancel</button>

                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Forgot Password?</button>

                        <div id="id01" class="modal">
                        
                            <form class="modal-content animate" action="/action_page.php" method="post">
                                <div class="container">
                                    <label for="uname"><b>Email</b></label>
                                    <input type="text" placeholder="Enter Email" name="uname" required>

                                    <button type="submit">Send Email!</button>
                                </div>

                                <div class="container" style="background-color:#f1f1f1">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <footer> 

        </footer>
    </body>
</html>