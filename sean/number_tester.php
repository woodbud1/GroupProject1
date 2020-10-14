<!DOCTYPE html>
<html>
    <head>
        <title>Number Tester</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>

    <body>
        <main>
            <h1>Number Tester</h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="process_data">

                <label>Number 1:</label>
                <input type="text" name="number1"
                       value="<?php echo htmlspecialchars($number1); ?>">
                <br><br>
                <label>Add (+)</label>
                <input type="radio" name="operator" value="add" <?php echo (isset($_POST['operator']) && $_POST['operator']=='add')? ' checked' : '';?>><br>
                <label>Subtract (-)</label>
                <input type="radio" name="operator" value="subtract" <?php echo (isset($_POST['operator']) && $_POST['operator']=='subtract')? ' checked' : '';?>><br>
                <label>Multiply (X)</label>
                <input type="radio" name="operator" value="multiply" <?php echo (isset($_POST['operator']) && $_POST['operator']=='multiply')? ' checked' : '';?>><br>
                <label>Divide (/)</label>
                <input type="radio" name="operator" value="divide" <?php echo (isset($_POST['operator']) && $_POST['operator'] === 'divide')? ' checked' : '';?>><br>
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