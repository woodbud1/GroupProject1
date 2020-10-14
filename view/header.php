<!DOCTYPE html>
<html lang="en">
<!-- The head -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="description" content="Group project website for Math.">
    <meta name="author" content="John Kyker">
    <link rel="stylesheet" href="<?php echo $pathcor; ?>./styling/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <div class="topnav">
        <nav>
         <?php
                    if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "!") {
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=home_index">Home</a></li>';
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=profile">Profile</a></li>';
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=test">Test</a></li>';
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=drill">Drill</a></li>';
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=flashcard">Flashcards</a></li>';
                        echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=about_index">About</a></li>';
                        echo'<a href="?action=logoff">Logoff</a></li>';

                    }else{
                        // if user is logged off display the following
                    echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=home_index">Home</a></li>';
                    echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=about_index">About</a></li>';
                    echo '<a href="';
                    echo htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    echo 'user_manager/?action=login_initial">Login</a></li>';
                    echo '<a href="';
                    echo $pathcor;
                    echo 'user_manager?action=registration">Registration</a></li>';
                    echo'<a href="'. htmlspecialchars($pathcor, ENT_QUOTES | ENT_HTML5, "UTF-8") . 'user_manager?action=drill">Drill</a></li>';
                    }
            ?>                
        </nav>
                </div>
    </div>
    <main role="main">