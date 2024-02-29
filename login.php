<?php
session_start();
include "start.php";
require_once './Facebook/Facebook/autoload.php'; 

$fb = new Facebook\Facebook([
    'app_id' => '1343800639625766',
    'app_secret' => '14c10dd136c0e327343357ad50aaed55',
    'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://your-website.com/fb-callback.php', $permissions);



if (isset($_POST['login'])) {


  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "select * from students where email='$email' and password='$password'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if ($count == 1) {
    $_SESSION["loggedin"] = true;
    $_SESSION['email'] = $rows['email'];
    $_SESSION['password'] = $rows['password'];
    header("location:view.php");
    exit();
  } 


}
?>
<html>

<head>
  <title> Login Page</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <!-- <div class="container">
  <div class="card"> -->
  <!-- <form method="post"> -->
  <!-- <input type="text" id="email" name="email" placeholder="mail" required>
      <input type="text" id="password" name="password" placeholder="********" required>
      <button type="submit" name="login">Login</button><br>
      <a href="create.php">Register</a> -->

  <body>

    <div class="main">

      <!-- Popup login form -->
      <div class="content">
        <div class="text">
          LOG IN
        </div>

        <form method="post">

          <label for="username">Email</label>
          <input type="text" placeholder="Email or Phone" name="email" id="username">

          <label for="password">Password</label>
          <input type="password" placeholder="Password" name="password" id="password">

          <!-- Create a login button in the popup login form -->
          <button type="submit" name="login">Login</button><br>
          <a href="<?php echo htmlspecialchars($loginUrl); ?>">Register with Facebook</a>
        </form>

        <a class="btn btn-success" href="create.php">Register</a>


      </div>
    </div>

  </body>



</html>
<!-- //////  -->
