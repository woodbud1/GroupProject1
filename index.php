<?php
require_once ('./model/user_db.php');
require_once ('./model/database.php');
require_once ('./model/user.php');
session_start();
// $pathcor = "./"
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'home_index';
    }
}
switch ($action) {
    case 'registration':
        include('./user_manager/registration.php');
        break;
    case 'add_user':
        // Fetch the data from the registration attempt
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $passTest = filter_input(INPUT_POST, "newpass");
        $userTest = $first_name.'.'.$last_name;
        // Values used for validation
        $validationCounter = 0;
        $isValid = true;

        $dupCounter = 0;

        // Validate the inputs
        if (
            empty($first_name) || empty($last_name) || empty($passTest)
        ) {
            $error_message = "Invalid user data! Check all fields and try again.";
            $isValid = false;
        } else {
            $isValid = true;
        }

        // Regex validation
        if (preg_match('/[A-Za-z]/', $first_name)) {
        } else {
            $error_message = "First Name must be letters.";
            $isValid = false;
        }

        if (preg_match('/[A-Za-z]/', $last_name)) {
        } else {
            $error_message = "Last Name must be letters.";
            $isValid = false;
        }

        if (preg_match('/^.{10,}$/', $passTest)) {
        } else {
            $error_message = "Password must be at least 10 characters long.";
            $isValid = false;
        }

        if (preg_match('/(?=.*[a-z])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*[A-Z])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*\d)/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*[@#$%^&*()\\[\]{}\-_=~`|:;])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if ($validationCounter >= 3) {
        } else {
            $error_message = "Password must have the following, an upper case letter, lower case letter, a digit and a special character.";
            $isValid = false;
        }

        // Test for duplicate username
        $userResult = UserDB::duplicateUser($userTest);
        if($userResult > 0){
            // Have a test string to increment against
            $userDupTest = $userTest;
            while ($userResult > 0) {
                // Go up a single digit every time there is a duplicate number
                $dupCounter++;
                $userDupTest = $userTest.$dupCounter;
                $userResult = UserDB::duplicateUser($userDupTest);
            } 
            $userTest = $userDupTest;
        } else{
            
        }

        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] != "!") {
            $error_message = "You are already logged in. You cannot be logged in while creating a new account.";
            $isValid = false;
        }

        // if its valid then insert data into the SQL Database
        if ($isValid == true) {
            // Make the password being tested the final password
            $password = $passTest;
            $user_name = $userTest;
            // Create the Session to validate the user is logged in and track name
            $_SESSION["user_name"] = $user_name;
            // Hash it for the server and pass it back to the password
            // $hash = password_hash($password, PASSWORD_BCRYPT);
            // $password = $hash;
            $i = new User($first_name, $last_name, $user_name, $password);
            UserDB::addUser($i);
            include('./user_manager/confirmation.php');
        } else {
            include('./user_manager/registration.php');
        }
        break;
    case 'login_initial':
        $loginerror_message = "";
        include('./user_manager/login.php');
        break;
    case 'login':
        $isValid = true;
        $hash = "!";
        $loginerror_message = "";
        $user_entry = filter_input(INPUT_POST, 'user_entry');
        $password_entry = filter_input(INPUT_POST, 'password_entry');
        $hashed_password = UserDB::authenticationUser($user_entry);
        if (isset($hashed_password[0])) {
            $hash = $hashed_password[0];
            trim($hash);
        }

        if ($password_entry === $hash) {
            $isValid = true;
        } else {
            $isValid = false;
            $loginerror_message = "Login Failed. Check username or password.";
        }
        /* if (password_verify($password_entry, $hash)) {
            $isValid = true;
        } else {
            $isValid = false;
            $loginerror_message = "Login Failed. Check username or password.";
        } */

        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "!") {
            $isValid = false;
            $loginerror_message = "Login Failed. Already logged in.";
        }

        if ($isValid == true) {
            $_SESSION["user_name"] = $user_entry;
            $loginerror_message = "Login Success!";
            include('./user_manager/login.php');
        } else {
            include('./user_manager/login.php');
        }
        break;
    case 'logoff':
        $_SESSION = array();
        session_destroy();
        $loginerror_message = "";
        include('./user_manager/logout.php');
        break;
    case 'profile':
        $user_message = '';
        $pass_message = '';
        if (isset($_SESSION["user_name"])) {
        } else {
            // This can never be set by a user naturally with the regex.
            $_SESSION["user_name"] = "!";
        }

        $user = $_SESSION["user_name"];

        if ($user === "!" || is_null($user))  {
            $error_message = "Not a member? Sign up here!";
            include('./user_manager/registration.php');
        } else {
            $user_display = $_SESSION["user_name"];
            // $userID = UserDB::fetchUserID($user_display);
            $user_image = UserDB::fetchImage($user_display);
            include('./user_manager/userprofile.php');
        }
        break;
    case 'changePassword':
        $passTest = filter_input(INPUT_POST, "newpass");
        $validationCounter = 0;
        $isValid = true;
        if (preg_match('/^.{10,}$/', $passTest)) {
        } else {
            $pass_message = "Password must be at least 10 characters long.";
            $isValid = false;
        }

        if (preg_match('/(?=.*[a-z])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*[A-Z])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*\d)/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*[@#$%^&*()\\[\]{}\-_=~`|:;])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if ($validationCounter >= 3) {
        } else {
            $pass_message = "Password must have the following, an upper case letter, lower case letter, a digit and a special character.";
            $isValid = false;
        }

        if ($isValid == true) {
            $password = $passTest;
            // If we absolutely insist on not being secure. 
            // Hash values are encrypted to 59/60 bytes so changing to BINARY(60) for password is easier. 
            // $hash = password_hash($password, PASSWORD_BCRYPT);
            $user = $_SESSION["user_name"];
            UserDB::changePassword($password, $user);
            $pass_message = "Password successfully updated";
        }

        $user_message = '';
        $email_message = '';
        $user_display = $_SESSION["user_name"];
        $userID = UserDB::fetchUserID($user_display);
        $user_image = UserDB::fetchImage($userID[0]);
        include('./user_manager/userprofile.php');
        break;
    case 'uploadImage':
        $user_display = $_SESSION["user_name"];
        $error;
        $pass_message = '';
        $email_message = '';
        $uploads_dir = '../images/uploads/';
        $isValid = true;
        if (isset($_FILES['image'])) {
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $temp = $_FILES['image']['name'];
            $temp = explode('.', $temp);
            $temp = end($temp);
            $file_ext = strtolower($temp);

            // var_dump($_FILES);

            $extensions = array("jpeg", "jpg", "png", "gif");
            // Check if it's a proper file extension
            if (in_array($file_ext, $extensions) === false) {
                $error = "file extension not in whitelist: " . join(',', $extensions);
                $isValid = false;
            }
            // Check file size             
            if ($_FILES['image']['size'] > 1000000) {
                $error = "File upload is too large.";
                $isValid = false;
            }

            if ($isValid == true) {
                $file_name = $user_display . $file_name;
                $upload_name = $uploads_dir . $file_name;
                move_uploaded_file($file_tmp, "$uploads_dir/$file_name");
                // $userID = UserDB::fetchUserID($user_display);
                UserDB::uploadImage($user_display, $upload_name);
                $user_image = UserDB::fetchImage($user_display);
                $user_message = "Success!";
                include('./user_manager/userprofile.php');
            } else {
                include('./errors/error.php');
            }
        }
        break;
    case 'home_index':        
        include('main_page.php');
        break;
    case 'about_index':
        define('directAccess', TRUE);
        if (isset($user_name) === true) :
            $user_name = $_SESSION["user_name"];
        elseif (isset($user_name) === false) :
            $user_name = null;
        endif;

        include('./about/index.php');
        break;
    case 'drill':
        $drill_body = "Answer Questions below.";
        $score = 0;
        $count = 0;
        $newFdigit = randdigit();
        $newSdigit = randdigit();
        $newOperator = randop();
        include('./drill/index.php');
    break;
    case 'drill_reset':
        $drill_body = "Drill Reset! Answer Questions below.";
        $count = 0;
        $score = 0;
        include('./drill/index.php');
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
            $drill_body = "Correct! $score out of $count";
        }
        else
        {   
            $count = $count + 1;
            $drill_body = "Incorrect! $score out of $count";
        }
        include('./drill/index.php');
    break;
    case 'flashcard':
        // I don't have any data to work with so I'm going to use leave this here for now...
        // $questions = questions_db::getQuestions();
        // include('./flashcards/index.php');
        break;
    break;
    default:
        $error = "Definitely, not suppose to be redirected here.";
        include('./errors/error.php');
        break;
}

