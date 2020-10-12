
<?php
$the_title = "MathWiz | Database Error";
$pathcor = "../";
require_once '../view/header.php';
?>
<main>
    <h1>Add Question</h1>
    <div class="question_add">
    <form action="index.php" method="post" id="add_question_form">
        <input type="hidden" name="action" value="add_question" />

        <label>Question:</label>
        <p>Addend 1:
        <input type="text" name="addendOne">
        <strong>+</strong>
        Addend 2:
        <input type="text" name="addendOne">
        </p>

        <label>Answer:</label>
        <input type="text" name="name">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product">
        <br>
    </form>
    <p><a href="index.php?action=list_products">View Question List</a></p>
    </div>
</main>
<?php include '../view/footer.php'; ?>