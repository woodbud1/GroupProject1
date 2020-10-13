<?php

//set default values
$number1 = rand(0, 9);
$number2 = rand(0, 9);
$message = 'Enter some numbers and click on the Submit button.';
$operand = filter_input(INPUT_POST, 'operator');
echo htmlspecialchars($operand);
$answer = 0;

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $number1 = filter_input(INPUT_POST, 'number1');
        $number2 = filter_input(INPUT_POST, 'number2');
        $number3 = filter_input(INPUT_POST, 'number3');

        if (ctype_digit(ltrim((string) $number1, '-'))) {

            if ($operand == "add") {
                $answer = $number1 + $number2;
                $message = "The answer is: " . $answer;
            }
            if ($operand == "subtract") {
                $answer = $number1 - $number2;
                $message = "The answer is: " . $answer;
            }
            if ($operand == "multiply") {
                $answer = $number1 * $number2;
                $message = "The answer is: " . $answer;
            }
            if ($operand == "divide") {
                if ($number2 == 0) {
                    $message = "Cannot divide by zero.";
                    break;
                } else {
                    $answer = $number1 / $number2;
                    $message = "The answer is: " . $answer;
                }
            }

            break;
        } else {
            $message = 'You must enter all numbers as integers.';
            break;
        }
}
include 'number_tester.php';
?>