<?php
$body = "";
$drill_action = filter_input(INPUT_POST, 'drill_action');
// $selected_key = filter_input(INPUT_POST, 'ops');
switch($drill_action){
    case NULL:
        $body = "Answer Questions below.";
        $score = 0;
        $count = 0;
        $newFdigit = randdigit();
        $newSdigit = randdigit();
        $newOperator = randop();
    break;
    /* case 'drill_selection':
        $body = "Answer Questions below.";
        $score = 0;
        $count = 0;
        $newFdigit = randdigit();
        $newSdigit = randdigit();
        // $newOperator = selectop();
    break; */
    case 'drill_reset':
        $body = "Drill Reset! Answer Questions below.";
        $count = 0;
        $score = 0;
    break;
    case 'drill_answer':
        $firstDigit = $_POST['lho'];
        $secondDigit = $_POST['rho'];
        $operator = $_POST['op'];
        $userAnswer = $_POST['answer'];
        $count = $_POST['count'];
        $score = $_POST['score'];
        $answer = evaluate($firstDigit, $secondDigit, $operator);
        
        if($answer == $userAnswer)
        {
            $count = $count + 1;
            $score = $score + 1;
            $body = "Correct! $score out of $count";
        }
        else
        {   
            $count = $count + 1;
            $body = "Incorrect! $score out of $count";
        }
    break;
    default:
break; 
}

function randdigit() {
    return mt_rand(0,9);
} 

function randop(){
    $ops = array('+', '-', '*');
    // pick a random index between zero and highest index in array.
    $randnum = mt_rand(0,sizeof($ops)-1);
    return $ops[$randnum];  // Use the index to pick the operator
}

/* function selectop(){
    $ops = array('+', '-', '*');
    return $ops[$selected_key];  // Use the index to pick the operator
} */

function evaluate($d1, $d2, $op) {
    switch($op) {
        case '+' : // addition
            $result = $d1 + $d2;
            break;
        case '-' : // subtraction
            $result = $d1 - $d2;
            break;
        case '*' : // multiplication
            $result = $d1 * $d2;
            break;
        default :  // Unidentified, return safe value
            $result = 0;
    }
    return $result;
}

?>