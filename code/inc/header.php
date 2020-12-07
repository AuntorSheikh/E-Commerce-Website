<?php 
ob_start();
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../helpers/Format.php');
   include_once ($filepath.'/../lib/Session.php');
   Session::init();
     spl_autoload_register(function ($class) {
     include 'classes/' . $class . '.php';
    });
     $ssid = session_id();
  $Menu = new Menu();
//  ?>
<!DOCTYPE html>
<html>
<head>
	<title>CSE311 project</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-light navbar-expand-sm bg-secondary" height="200" >
    <div class="container">
        <a href="index.php" class="navbar-brand" data-toggle="tooltip" title="Cyber Cafe Owners Assoication of Bangladesh">
          <img class="img-fluid mx-auto deming" src="images/leaf.png" width="80" alt="">
          
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menu" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
           <span class="mr-auto"></span>
            <ul class="navbar-nav">
                <li class="nav-item middle_header pr-3" style="border: 1px solid grey;">
                    <a href="cart.php" class="nav-link text-light"><span class="fa fa-cart"></span> Cart(<span class="text-danger" id="carting">0</span>)</a>
                </li>
                <li class="nav-item active middle_header" style="border: 1px solid grey;">
                    
                </li>
    <?php 

     if (isset($_GET['cid'])) {
        //$delid = $ct->delCustomerCart();
        Session::destroy();
     }
     // $path = $_SERVER['SCRIPT_FILENAME'];
     // $currentpage = basename($path,'.php');


     ?>
               <?php 
                   $login = Session::get('cuslogin');
                   $dd = Session::get('cmrId');
                    if (!$login) {
                        echo '<a href="login.php" class="nav-link text-light"><span class="glyphicon glyphicon-home"></span> Login</a>';
                    }else{
                        echo '<a href="?cid=<?php echo $dd; ?>" class="nav-link text-light"><span class="glyphicon glyphicon-home"></span> Logout</a>';
                    }
                ?>
            </ul>
        </div>
     
    </div>
</nav>
