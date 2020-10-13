
<?php
$the_title = "MathWiz | Database Error";
$pathcor = "../";
require_once '../view/header.php';
?>
<main>
    <div class="question_add">
        <h1>Add Question</h1>

        <form action="index.php" method="post" id="add_question_form">
            <input type="hidden" name="action" value="add_question" />

            <label>Question:</label>
            <p>
                <input type="number" name="addendOne">
                <span class="question_add_char">+</span>
                <input type="number" name="addendOne">
                <span class="question_add_char">=</span>
                <input type="number" name="answer">
            </p>

            <label>&nbsp;</label>
            <input type="submit" value="Add Question">
            <br>
        </form>
        <p><a href="index.php?action=list_questions">View Question List</a></p>
    </div>
</main>
<?php include '../view/footer.php'; ?>