<?php
$the_title = "MathWiz | Profile";
$pathcor = "../";
require_once '../view/header.php';
?>
<h1>Welcome, <?php echo $user_display ?>!</h1>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php
            if (isset($user_image[0])) {
                echo '<img class="profilepic" src="';echo htmlspecialchars($user_image[0], ENT_QUOTES | ENT_HTML5, 'UTF-8');echo'" alt="User Profile Pic" width="100%" height="50%">';
            } else {
                echo '<h3>Once you have set a image for your profile picture, it will appear here.</h3>';
            } ?>
        </div>
        <div class="col-sm-6">
            <?php if (isset($user_image[0])) {
                echo '<label>Change Profile picture here: </label><br>';
            } else {
                echo '<h3>Add your profile picture here!</h3>';
            } ?><form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="uploadImage" />
                <input type="file" name="image" />
                <input type="submit" />
            </form>
            <form action="index.php" method="POST">
                <span class="error"><?php echo htmlspecialchars($pass_message, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></span><br>
                <input type="hidden" name="action" value="changePassword" />
                <label>Password: </label><br>
                <input type="password" name="newpass" placeholder="Change Password"><br>
                <input type="submit" value="Submit"><br>
            </form>
            <br>
            <br>
            <form action="index.php" method="POST">
                <input type="submit" value="Log Off!" />
                <input type="hidden" name="action" value="logoff" />
            </form>
        </div>
    </div>
</div>
<?php require_once '../view/footer.php'; ?>