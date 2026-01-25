<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conquering Responsive Layouts</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
      integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/sign-up.css" />
    <style>
      .alert {
        padding: 15px;
        margin: 20px auto;
        border-radius: 5px;
        text-align: center;
        max-width: 500px;
      }
      .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
      }
      .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="site-tagline-hero">
        <div class="container row">
          <div class="site-tagline-row">
            <a href="#">
              <img src="/assets/logo.svg" alt="" class="site-logo" />
            </a>
            <a href="" class="hamburger-menu"><i class="ri-menu-line"></i></a>
          </div>
          <nav class="navigation">
            <ul class="nav-list">
              <li class="nav-item">
                <a href="/html/index.html" class="nav-link">HOME</a>
              </li>
              <li class="nav-item">
                <a href="/html/about.html" class="nav-link">ABOUT</a>
              </li>
              <li class="nav-item"><a href="" class="nav-link">CONTACT</a></li>
              <li class="nav-item">
                <a href="/sign-up.php" class="nav-link">SIGN UP</a>
              </li>
              <li class="nav-item">
                <a href="/sign-in.php" class="nav-link nav-link-button">SIGN IN</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
        unset($_SESSION['success']);
    }
    ?>

    <section>
      <form action="/register.php" method="POST">
        <div class="container">
          <div class="form-group">
            <label for="name">Name</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Enter your name"
              required
            />
          </div>
          <div class="form-group">
            <label for="surname">Surname: </label>
            <input
              type="text"
              id="surname"
              name="surname"
              placeholder="Enter your Surname"
              required
            />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter your email"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
          <p style="text-align: center; margin-top: 20px;">
            Already have an account? <a href="/sign-in.php">Sign in here</a>
          </p>
        </div>
      </form>
    </section>

    <main class="main">
      <div class="container">
        <h2 class="main-title">SIGN UP TO OUR COURSE!</h2>
      </div>
    </main>

    <script src="/js/main.js"></script>
  </body>
</html>
