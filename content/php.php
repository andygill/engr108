<?php

// Holds the user name, *if* login is validated
$user = $_COOKIE["engr108user"];
$pin  = $_COOKIE["engr108pin"];

if (isset($user)) {
  if (isset($pin)) {
    $state = "active";
  } else {
    $state = "pin";
  }
} else {
  $state = "splash";
}

// Show an alert, because something went badly wrong.
function alert($msg) {
  echo "<script>";
  echo "alert('$msg');";
  echo "window.location.href='".$_SERVER['REQUEST_URI'] . "'";
  echo "</script>\n";
  die();
}

function title()
{
  print "ENGR 108 Signin Page";
} 

$hack = "";

      $alert = "Login problem"; 
      
      
// First, check for login request.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $debug = "";

    if (isset($_REQUEST["logout"])) {
      setcookie("engr108user","",time() - 3600);
      setcookie("engr108pin","",time() + 3600);
      $debug = "#logout";

    } elseif (isset($_REQUEST["email"])) {

      // Check _REQUEST["pin"] for hash.
      // If so, please proceed
      if ($_REQUEST["email"] != "") {
        setcookie("engr108user",$_REQUEST["email"],time() + 3600);
        $debug = "#login";

        // mail ( "andygill@ku.edu", "Hello", "World");

//          alert("Login rejected. Please try again.");

      } else {
        // Just redirect, please.
        $debug = "#non-login";
      }

    } elseif (isset($_REQUEST["pin"])) {
      // Assuming engr108user is here
      setcookie("engr108pin",$_REQUEST["pin"],time() + 3600);
      $debug = "#pin";

    } else {
      // Do nothing, just redirect.

      $alert = "Login problem"; 
      $debug = "#other";

    }

    header( "Location: " . $_SERVER['REQUEST_URI'] . $debug, 303);
    die();

  phpinfo();
}

// We are now commited to the page.
  
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title><?php title(); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">


  </head>

  <body>


   <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand">ENGR 108</div>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li> 
              <a class="btn btn-primary">Log out</a></li>
          </ul>

<?php if ($state == "splash") { ?>

          <form class="navbar-form navbar-right" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Email" name="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>


<?php } else { ?>

          <form class="navbar-form navbar-right" method="POST">
            <input type="hidden" name="logout">
            <button type="submit" class="btn btn-primary">Log out</button>
          </form>
          <div class="navbar-brand nav navbar-right">
            <?php 
              if ($state == "pin") {
                echo "Logging in as $user ($state)"; 
              } elseif ($state == "active") {
                echo "Logged in as $user ($state)";                 
              } else {
                echo "Impossible ($state)";
//                  alert("The impossible happens!");
              }
            ?>
          </div>

<?php } ?>

        </div><!--/.nav-collapse -->

      </div>
    </div>

<?php if ($state == "splash") { ?>

      <div class="container">
  <BR>
    <div class="jumbotron">
        <h1>ENGR 108</h1>
        <p>Welcome to ENGR 108 and good luck escaping from Crater Lake.</p>
        <p>Please sign in with your KU email and ENGR 108 PIN.</p>

        <p>If you need a PIN, please email <tt>andygill@ku.edu</tt> from your KU account, with <BR>Subject: "ENGR 108 Password"</p>
      </div>
    </div>

<?php } elseif ($state == "pin") { ?>

        <br>

      <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel  panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">ENGR 108 Authentication</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">PIN</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" id="inputEmail3" name="pin" placeholder="PIN">
                </div>
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-default">Sign in</button>
                </div>
              </div>
           </form>

            <HR>

            <form class="form-horizontal" role="form">
                <div class="form-group">
                  <p class="col-sm-6 col-sm-offset-2">
                    If you do not have a PIN, or have forgotten it, 
                    you can request to have one mailed to you.
                  </p>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-default">Mail PIN</button>
                  </div>
                </div>

</form>


          </div>
        </div>
</div>


      </div>

<?php } else { ?>

  
      <br/>

      <div class="container">
        <div class="col-md-8">
          Game!
        </div>
        <div class="col-md-4">
            <textarea class="form-control" rows="20"></textarea>
      </div>
    </div>

<?php } ?>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
