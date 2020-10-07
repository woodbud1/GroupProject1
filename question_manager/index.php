<?php
/* require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php'); */
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_questions';
    }
}
switch ($action) {
    case 'list_questions':
        include('question_list.php');
        break;
    case 'show_add_form':
        include('add_question');
        break;
    case 'add_question':
        $addendOne = filter_input(INPUT_POST, 'addendOne');
        $addendTwo = filter_input(INPUT_POST, 'addendTwo');
        $sum = filter_input(INPUT_POST, 'sum');
        break;
    case 'delete_question':
        break;
    case 'show_edit_form':
        break;
    case 'edit_question':
        break;
}        