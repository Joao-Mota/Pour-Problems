<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');


  require_once(__DIR__ . '/../temp/common.tpl.php');
  

  $db = getDatabaseConnection();

  drawHeader($session); 
?>

<section class="login">
  <div class="logo">
    <img src="../sources/PourProblems_Logo_Gray.png" alt="logo">
  </div>


  <div class="login-input">
    <h2 class="title">Login</h2>
    <form action="../actions/action_login.php" method="post" class="login-container">
      
    <!-- Email and password -->
      <input type="email" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
      
      <div class="login-options">
        <!-- Login button -->
        <button type="submit"><span class="login-btn"><i class="fas fa-arrow-right"></i></span></button>
        
        <!-- Stay logged in -->
        <div class="stay-logged-in">
          <input type="checkbox" id="stay_logged_in_check" value="true">
          <label for="stay_logged_in_check">Stay logged in</label>
        </div>
      </div>

      <!-- Links -->
      <div class="login-links">
        <a class="forgot-password" href="/pages/forgot_password.php">Forgot your password?</a>
        <a class="register" href="/pages/signup.php">Don't have an account?</a>
      </div>
      
    </form>
  </div>
</section>


<?php
  drawFooter();
?>