<?php
$the_title = "Profile comments";
$pathcor = ".";
$showloginbar = 1;
require_once './view/header.php';
?>

<body>
    <main>

        <h1>Welcome to <?php echo htmlspecialchars($view_user, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>'s profile!</h1>
        <?php

                    $imagepath = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '../images/uploads/';
                    foreach (new DirectoryIterator('../images/uploads/') as $fileName) {
                        if ($fileName->isDot()) continue;
                        if (strpos($fileName, $view_user) !== false) {
                            // If found match break to preserve imagepath.
                            break;
                        } else {
                            //set to null for later check and keep going
                            $fileName = null;
                        }
                    }

                    // if user has profile pic set display it, else, display default user image.
                    if (isset($fileName) === true) {
                        echo '<img src="' . $imagepath . $fileName . '" alt="User Profile Pic" width="100vw" height="100vh">';
                    } else {
                        echo '<img src="' . $imagepath . 'default.jpg' . '" alt="User Profile Pic" width="100vw" height="100vh">';
                    } 
                    
                    if(isset($_SESSION["view_user"])) :
                        $view_user = $_SESSION["view_user"];
                        $profile = $view_user;
                    endif;    
                    
                    ?>


        <form action="." method="post">
            <input type="hidden" name="action" value="post_comment">
            <h2>Post a comment</h2>
            <label>Type comment here (Max Characters for comment: 2500)</label>
            <input type="text" name="acomment" rows="4" cols="50"></textarea>
            <input type="submit" name="submit" class="btn btn-success" value="Submit">
        </form>
        <br><br>
        <span class="error"><?php echo htmlspecialchars($error_message, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></span>
    </main>
</body>

</html>
<?php require_once '../view/footer.php'; ?>