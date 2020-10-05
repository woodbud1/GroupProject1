<?php
$the_title = "Confirmation";
$pathcor = "../";
$showloginbar = 1;
require_once '../view/header.php';
?>
    <body>
        <main>
            <h1>Thanks for Signing Up!</h1>
            <p>Here is the information we have registered.</p>
            <p>First Name: <?php echo htmlspecialchars($first_name, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
            <p>Last Name: <?php echo htmlspecialchars($last_name, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
            <p>Username: <?php echo htmlspecialchars($user_name, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
            <p>Password: <?php echo htmlspecialchars($passTest, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
     </main>
    </body>
<?php require_once '../view/footer.php'; ?> 

