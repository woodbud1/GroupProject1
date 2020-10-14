<?php

$the_title = "MathWiz | Drill";
$pathcor = "../";
$newFdigit = randdigit();
$newSdigit = randdigit();
$newOperator = randop();
require_once '../view/header.php';
?>

<div class="box">
<h1 style="color:black;">Math Drills!</h1>
<?php 
    print $drill_body;
?>
</div>
<!-- <form method="post" action="." >
<input type="hidden" name="action" value="drill_selection">
<label for="ops">Choose a Drill:</label>
<input type="number">
<input type="submit" name="ops" value="Submit" />
</form> -->
<form class="box" method="post" action="." >
<input type="hidden" name="action" value="drill_answer">
    <h3><?php echo $newFdigit; ?> <?php echo $newOperator; ?> <?php echo $newSdigit; ?> = ? 
    <input type="text" name="answer" size="2" /></h3>
    <p><input type="submit" name="submit" value="Submit" />
    <input type="hidden" name="lho" value="<?php echo $newFdigit ?>" />
    <input type="hidden" name="rho" value="<?php echo $newSdigit; ?>" />
    <input type="hidden" name="op" value="<?php echo $newOperator; ?>" />
    <input type="hidden" name="score" value="<?php echo $score; ?>" />
    <input type="hidden" name="count" value="<?php echo $count; ?>" /></p>
</form>
<form class="box" method="post" action="." >
<input type="hidden" name="action" value="drill_reset">
<p><input type="submit" name="Reset" value="Reset" />
</form>
<?php require_once '../view/footer.php'; ?>