<!DOCTYPE html>
<html lang="en">
<!-- The head -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="description" content="Group project website for Math.">
    <meta name="author" content="John Kyker">
    <link rel="stylesheet" href="<?php echo $pathcor; ?>style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css">
    <link rel="icon" href="<?php echo $pathcor; ?>images/bIcon.png">
    <title><?php echo $the_title; ?></title>
</head>

<body>
    <!-- if user logged in show who's logged in, else show logged off -->
    <?php
    if (isset($showloginbar) && $showloginbar === 1) {
        echo  '<div class="loginbar"><span>You are currently <b>';

        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "!") {
            echo 'logged on as: ' . $_SESSION["user_name"];
        } else {
            echo 'logged off';
        }
        echo '</b></span></div>';
    } else {
        //Do nothing
    }
    ?>
    <!-- Navbar -->
    <div class="jumbotron text-center">
        <h1>SCC Social Media!</h1>
        <nav>
            <ul class="navstyle">
         <?php
                    if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "!") {
                        //if user is logged in display the following
                        echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=profile">Profile</a></li>';
                        echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=">Test</a></li>';
                        echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=">Drill</a></li>';
                        echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=">About</a></li>';
                        echo ' <li class="nav-item active"><a href="?action=logoff">Logoff</a></li>';

                    }else{
                        // if user is logged off display the following
                    echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=home_index">Home</a></li>';
                    echo'<li class="nav-item active"><a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=about_index">About</a></li>';
                    echo '<li class="nav-item active"><a href="';
                    echo htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    echo 'user_manager/?action=login_initial">Login</a></li>';
                    echo '<li class="nav-item active"><a href="';
                    echo $pathcor;
                    echo 'user_manager?action=registration">Registration</a></li>';
                    }
            ?>                
            </ul>
        </nav>
    </div>
    <main role="main">