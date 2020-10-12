<?php

//set default values
$number1 = rand(0, 9);
$number2 = rand(0, 9);
$message = 'Enter some numbers and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $number1 = filter_input(INPUT_POST, 'number1');
        $number2 = filter_input(INPUT_POST, 'number2');
        $number3 = filter_input(INPUT_POST, 'number3');

        if (ctype_digit(ltrim((string) $number1, '-'))) {


            // get the ceiling and floor for $number2
            $number2_ceil = ceil($number2);
            $number2_floor = floor($number2);

            // round $number3 to 3 decimal places
            $number3_rounded = round($number3, 3);

            // get the max and min values of all three numbers
            $max = max($number1, $number2, $number3);
            $min = min($number1, $number2, $number3);

            // generate a random integer between 1 and 100
            $random = mt_rand(1, 100);

            // format the message
            $message = "Number 1: $number1\n" .
                    "Number 2: $number2\n" .
                    "Number 3: $number3\n" .
                    "\n" .
                    "Number 2 ceiling: $number2_ceil\n" .
                    "Number 2 floor: $number2_floor\n" .
                    "Number 3 rounded: $number3_rounded\n" .
                    "\n" .
                    "Min: $min\n" .
                    "Max: $max\n" .
                    "\n" .
                    "Random: $random\n";

            break;
        } else {
            $message = 'You must enter all numbers as integers.';
            break;
        }
}
include 'number_tester.php';
?>