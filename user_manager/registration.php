<?php
$the_title = "MathWiz | Registration";
$pathcor = "../";
require_once '../view/header.php';
if (!isset($error_message)) {
    $error_message = '';
}
?>
<div class=
<h1>Registration</h1>
<h3>
Be excited and sign up below.</h3>
</h3>
    Password guidelines: Password must have the following, an upper case letter, lower case letter, a digit and a special character.
    Password must be at least 10 characters long.</p>
<form action="." method="post">
    <input type="hidden" name="action" value="add_user">
    <span class="error"><?php echo htmlspecialchars($error_message, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></span><br><br>
    <label class='emp'>First Name: </label>
    <input type="text" name="first_name" placeholder="Enter your first name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"><br>
    <label class='emp'>Last Name: </label>
    <input type="text" name="last_name" placeholder="Enter your last name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"><br>
    <label class='emp'>Password: </label>
    <input type="password" name="newpass" placeholder="Create password" value="<?php if (isset($_POST['newpass'])) echo $_POST['newpass']; ?>"><br><br>
    <label class='emp'>&nbsp;</label>
    <!-- <div class="g-recaptcha" data-sitekey="6Le2Q-0UAAAAAFuXSxiXvheNHAT08ykR7tTgsyq9"></div> -->
    <br>
    <input class='bigbutton' type="submit" value="Submit"><br><br>
</form>
<p>Already have an account? <a href="login.php">Login Here</a></p>

<?php require_once '../view/footer.php'; ?>