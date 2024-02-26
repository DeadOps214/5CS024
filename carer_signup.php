<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carer Sign Up - Helping Hands</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Add your custom CSS styles here -->
  <style>
    /* Add your custom CSS styles here */
    /* You can copy the CSS styles from your main HTML file */
  </style>
</head>
<body>

<div class="container">
  <h1>Carer Sign Up</h1>
  <!-- Carer sign-up form -->
  <form action="carer_register.php" method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <!-- Other carer-specific fields can be added here -->
    <button type="submit" class="btn btn-primary">Sign Up</button>
  </form>
</div>

</body>
</html>