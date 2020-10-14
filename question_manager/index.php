<?php
require('../model/database.php');
require('../model/question.php');
require('../model/question_db.php');
//session_start();
//
//set default values


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_questions';
    }
}
switch ($action) {
    case 'list_questions':                       //Go to Display All Questions View
        $questions = questions_db::getQuestions();
        include('question_list.php');
        break;
    case 'show_add_form':
        include('add_question');
        break;
    case 'add_question':
        $number1 = filter_input(INPUT_POST, 'number1');
        $number2 = filter_input(INPUT_POST, 'number2');
        $answer = filter_input(INPUT_POST, 'answer');
        $operand = filter_input(INPUT_POST, 'operand');

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

            $question = new Question($number1, $number2, $answer, $operand);
            questions_db::addQuestion($question);
        } else {
            $message = 'You must enter all numbers as integers.';
            break;
        }    
    case 'delete_question':
        break;
    case 'show_edit_form':
        break;
    case 'edit_question':
        break;
}        