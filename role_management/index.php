<?php
require_once ('../model/user_db.php');
require_once ('../model/database.php');
require_once ('../model/user.php');
require ('../model/role_db.php');
require ('../model/role.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'All_Roles';
    }
    
switch ($action) {
        
    case 'All_Roles':        
    $roles = RoleDB::getRoles();
    include('./role_management.php');
    break;

    default:
        $error = "Definitely, not suppose to be redirected here.";
        include('../errors/error.php');
        break;
}
}