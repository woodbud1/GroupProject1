<?php 
$the_title = "MathWiz | Error!";
$pathcor = "../";
require_once '../view/header.php';
?>
    <h1>Error</h1>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php require_once '../view/footer.php'; ?>