<?php

// Holds the user name, *if* login is validated
$user = $_REQUEST["engr108user"];

function title()
{
  print "ENGR 108 Signin Page";
} 

$hack = "";


// First, check for login request.
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_REQUEST["logout"])) {
      setcookie("engr108user","",time() - 3600);

    } elseif (isset($_REQUEST["email"])) {

      // Check _REQUEST["pin"] for hash.
      // If so, please proceed
      setcookie("engr108user",$_REQUEST["email"],time() + 3600);

    } else {
      // Do nothing, just redirect.
    }

    header( "Location: " . $_SERVER['REQUEST_URI'], 303);
    die();
}

// Login depends on engr108user being set.

//cho $_REQUEST["eecs168"];

//  $hack = "<h1>NOT POST</h1>";
  
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
          <a class="navbar-brand" href="#">ENGR 108</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>

<?php if (isset($user)) { ?>

          <form class="navbar-form navbar-right" method="POST">
            <input type="hidden" name="logout">
            <button type="submit" class="btn btn-primary">Log out</button>
          </form>
          <div class="nav navbar-right">
            <a class="navbar-brand" href="#">Logged in as: <? echo $user; ?></a>
          </div>


<?php } else { ?>

          <form class="navbar-form navbar-right" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="ENGR 108 PIN" name="pin" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>

<?php } ?>

        </div><!--/.nav-collapse -->

      </div>
    </div>

 

    <div class="jumbotron">
      <div class="container">
        <h1>ENGR 108</h1>
        <p>Welcome to ENGR 108!</p>
        <p>Please sign in above with your ENGR 108 PIN.</p>
      </div>
    </div>

    <?php echo $hack; ?>

    <?php if (isset($user)) { echo "($user)"; } else { echo "[ NOT SET ]"; } ?>

    <?php echo $_REQUEST["eecs168"]; ?>

    <?php phpinfo(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
