<?php
require 'functions.php';
$newFdigit = randdigit();
$newSdigit = randdigit();
$newOperator = randop();
?>


<h1>Math Quiz</h1> <br /> <br />
<?php 
    print $body;
?>
<form method="post" action="." >
<input type="hidden" name="action" value="drill_selection">
<label for="ops">Choose a Drill:</label>
<select id="ops" name="ops">
  <option value="1">Add</option>
  <option value="2">Subtraction</option>
  <option value="3">Multiple</option>
  <option value="4">Division</option>
</select>
<input type="submit" name="submit" value="Submit" />
</form>
<form method="post" action="." >
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

