
<?php

$the_title = "MathWiz | Database Error";
$pathcor = "../";
require_once '../view/header.php'; ?>
<main>
    <h2>Question List</h2>
    <table>
        <tr>
            <th>Question</th>
            <th>Answer</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($questions as $question) : ?>
            <tr>
                <td><?php echo $question->getAddendOne() . "+" . $question->getAddendTwo(); ?></td>
                <td><?php echo $question->getAnswer(); ?></td>
                <td><form action="." method="post"
                          id="delete_question_form">
                        <input type="hidden" name="action"
                               value="delete_question">
                        <input type="hidden" name="question_id"
                               value="<?php echo $question->getID(); ?>">
                        <input type="submit" value="Delete">
                    </form></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Question</a></p>
</main>
<?php include '../view/footer.php'; ?>