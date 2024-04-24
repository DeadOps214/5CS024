<?php
session_start();

    include("connection.php");
    include("functions.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Helping Hands - Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    header {
      text-align: center;
      padding: 50px 0;
      background-color: #f9f9f9;
    }
    header h1 {
      font-size: 36px;
    }
    header img {
      width: 50px; /* Adjust the width of the logo as needed */
      margin-right: 10px;
    }
    section {
      padding: 20px;
    }
    footer {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    footer a {
      color: #fff;
    }
    .navbar-brand img {
      width: 30px; /* Adjust the width of the logo as needed */
      margin-right: 10px;
    }
    .jumbotron {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#"><img src="logo.jpg" alt="Helping Hands Logo"> Helping Hands</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Carers
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
          <a class="dropdown-item" href="carer_login.php">Login</a>
          <a class="dropdown-item" href="carer_register.php">Register</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Patients
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <a class="dropdown-item" href="patient_login.php">Login</a>
          <a class="dropdown-item" href="patient_register.php">Register</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<header>
  <h1>Connecting Carers and Customers</h1>
  <p>Your Trusted Platform for Elderly Care</p>
</header>

<div class="container">
  <div class="jumbotron">
    <h2>About Helping Hands</h2>
    <p>At Helping Hands, we are dedicated to creating a nurturing environment where carers and elderly customers can connect and build meaningful relationships. Our platform offers a seamless experience for scheduling appointments, communication, and providing feedback.</p>
  </div>
  
  <section id="services">
    <h2>Our Services</h2>
    <div class="row">
      <div class="col-md-4">
        <h4>Appointment Scheduling</h4>
        <p>Easily create and manage appointments with your preferred carers.</p>
      </div>
      <div class="col-md-4">
        <h4>Carer Selection</h4>
        <p>Patients can choose what carer they book their appointments with.</p>
      </div>
      <div class="col-md-4">
        <h4>Secure Communication</h4>
        <p>Communicate securely with your chosen carers through our platform to discuss requirements and arrangements.</p>
      </div>
    </div>
  </section>

  <section id="why-choose">
    <h2>Why Choose Helping Hands?</h2>
    <div class="row">
      <div class="col-md-4">
        <h4>Trusted Network</h4>
        <p>We carefully vet all carers to ensure they meet our strict standards for professionalism and reliability.</p>
      </div>
      <div class="col-md-4">
        <h4>User-Friendly Interface</h4>
        <p>Our intuitive platform makes it simple for both carers and seniors to navigate and use.</p>
      </div>
      <div class="col-md-4">
        <h4>24/7 Support</h4>
        <p>Our dedicated support team is available round-the-clock to assist you with any queries or concerns.</p>
      </div>
    </div>
  </section>
</div>

<footer>
  <section id="contact">
    <h3>Contact Us</h3>
    <p>Have questions or need assistance? Reach out to us at <a href="mailto:support@helpinghands.com">support@helpinghands.com</a> or call us at 1-800-HELPING.</p>
    <p>Follow us on social media for updates and tips: <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a></p>
  </section>
  <p>Helping Hands - Connecting Hearts, Enriching Lives.</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>