<?php
$number1 = rand(0, 9);
$number2 = rand(0, 9);
$message = 'Enter some numbers and click on the Submit button.';
$operand = filter_input(INPUT_POST, 'operator');
echo htmlspecialchars($operand);
$answer = 0; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Number Tester</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>

    <body>
        <main>
            <h1>Add Question</h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="process_data">

                <label>Number 1:</label>
                <input type="text" name="number1"
                       value="<?php echo htmlspecialchars($number1); ?>">
                <br><br>
                <label>Add (+)</label>
                <input type="radio" name="operator" value="add"><br>
                <label>Subtract (-)</label>
                <input type="radio" name="operator" value="subtract"><br>
                <label>Multiply (X)</label>
                <input type="radio" name="operator" value="multiply"><br>
                <label>Divide (/)</label>
                <input type="radio" name="operator" value="divide"><br>
                <br>
                <label>Number 2:</label>
                <input type="text" name="number2"
                       value="<?php echo htmlspecialchars($number2); ?>">
                <br>
                <label>&nbsp;</label>
                <input type="submit" value="Submit">
                <br>

            </form>

            <h2>Message:</h2>
            <p><?php echo nl2br(htmlspecialchars($message), FALSE); ?></p>

        </main>
    </body>
</html>