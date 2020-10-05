<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'registration';
    }
}
switch ($action) {
    case 'registration':
        include('registration.php');
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

        } else{
            // Have a test string to increment against
            $userDupTest = $userTest;
            while ($userResult > 0) {
                // Go up a single digit every time there is a duplicate number
                $dupCounter++;
                $userDupTest = $userTest.$dupCounter;
                $userResult = UserDB::duplicateUser($userDupTest);
            } 
            $userTest = $userDupTest;
        }

        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] != "!") {
            $error_message = "You are already logged in. You cannot be logged in while creating a new account.";
            $isValid = false;
        }

        /* 
        // Looking into recaptcha v3 but you have to register an online domain to get it to function. Still cool to learn from Google Dev Tools.
        // Checks if form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            function post_captcha($user_response) {
            $fields_string = '';
            $fields = array(
            'secret' => '6Le2Q-0UAAAAABRsVE94ifbJge50qp2Ss91lyzgm',
            'response' => $user_response
            );
            foreach($fields as $key=>$value)
            $fields_string .= $key . '=' . $value . '&';
            $fields_string = rtrim($fields_string, '&');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

         // Call the function post_captcha
        $res = post_captcha($_POST['g-recaptcha-response']);

        if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        $error_message = 'Please go back and make sure you check the security CAPTCHA box.';
        $isValid = false;
        } else {
        // If CAPTCHA is successfully completed...
        $isValid = true;
             }
        } */

        // if its valid then insert data into the SQL Database
        if ($isValid == true) {
            // Make the password being tested the final password
            $password = $passTest;
            $user_name = $userTest;
            // Create the Session to validate the user is logged in and track name
            $_SESSION["user_name"] = $user_name;
            // Hash it for the server and pass it back to the password
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $password = $hash;
            // $i = new User($first_name, $last_name, $email, $user_name, $password);
            // UserDB::addUser($i);
            include('confirmation.php');
        } else {
            include('registration.php');
        }
        break;
    case 'login_initial':
        $loginerror_message = "";
        include('login.php');
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


        if (password_verify($password_entry, $hash)) {
            $isValid = true;
        } else {
            $isValid = false;
            $loginerror_message = "Login Failed. Check username or password.";
        }

        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "!") {
            $isValid = false;
            $loginerror_message = "Login Failed. Already logged in.";
        }

        if ($isValid == true) {
            $_SESSION["user_name"] = $user_entry;
            $loginerror_message = "Login Success!";
            include('login.php');
        } else {
            include('login.php');
        }
        break;
    case 'logoff':
        $_SESSION = array();
        session_destroy();
        $loginerror_message = "";
        include('login.php');
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

        if (is_null($user)) {
            $error_message = "Not a member? Sign up here!";;
            include('registration.php');
        }

        if ($user === "!") {
            $error_message = "Not a member? Sign up here!";
            include('registration.php');
        } else {
            $user_display = $_SESSION["user_name"];
            $userID = UserDB::fetchUserID($user_display);
            $user_image = UserDB::fetchImage($userID[0]);
            include('userprofile.php');
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
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $user = $_SESSION["user_name"];
            UserDB::changePassword($hash, $user);
            $pass_message = "Password successfully updated";
        }

        $user_message = '';
        $email_message = '';
        $user_display = $_SESSION["user_name"];
        $userID = UserDB::fetchUserID($user_display);
        $user_image = UserDB::fetchImage($userID[0]);
        include('userprofile.php');
        break;
    // case 'changeEmail':
    //     $emailTest = filter_input(INPUT_POST, "newemail");
    //     $emailResult = UserDB::duplicateEmail($emailTest);
    //     if ($emailResult > 0) {
    //         $email_message = "E-mail in use.";
    //     } else {
    //         $newEmail = $emailTest;
    //         $user = $_SESSION["user_name"];
    //         $email_message = "E-mail successfully updated.";
    //         UserDB::changeEmail($newEmail, $user);
    //     }

    //     $pass_message = '';
    //     $user_message = '';
    //     $user_display = $_SESSION["user_name"];
    //     $userID = UserDB::fetchUserID($user_display);
    //     $user_image = UserDB::fetchImage($userID[0]);

    //     include('userprofile.php');
    //     break;
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
                $userID = UserDB::fetchUserID($user_display);
                UserDB::uploadImage($userID[0], $upload_name);
                $user_image = UserDB::fetchImage($userID[0]);
                $user_message = "Success!";
                include('userprofile.php');
            } else {
                include('../errors/error.php');
            }
        }
        break;
        /*
    case 'list_users':
        $a = '<p class="alert alert-success" role="alert" type="hidden" >';
        $b = '<p class="alert alert-danger" role="alert" type="hidden" >';
        $c = ' </p>';
        $errMessage = filter_input(INPUT_GET, "errMessage");
        $sucMessage = filter_input(INPUT_GET, "sucMessage");
        if (isset($view_user)) :
            $view_user = $_SESSION["view_user"];
        else :
            $view_user = '';
        endif;
        if (isset($_SESSION["view_user"])) :
            $view_user = $_SESSION["view_user"];
            $profile = $view_user;
        endif;
        if (isset(($_SESSION["user_name"]))) :
            $commenterProfile = $_SESSION["user_name"];
            $_SESSION["thier_username"] = $_SESSION["user_name"];
        else :
            $view_user = '';
        endif;
        $users = UserDB::getUsers();
        include('users_directory.php');
        break;
    case 'view_profile':
        $_SESSION["view_user"] = filter_input(INPUT_POST, "profile");

        if (isset($_SESSION["view_user"])) :
            $view_user = $_SESSION["view_user"];
            $profile = $view_user;
        endif;
        if (isset(($_SESSION["user_name"]))) :
            $commenterProfile = $_SESSION["user_name"];
            $entry = $commenterProfile;
            $_SESSION["thier_username"] = $_SESSION["user_name"];
        else :
            $view_user = '';
        endif;
        $view_user = $_SESSION["view_user"];
        //$commenterProfile = $_SESSION["user_name"];
        $error_message = '';

        include('public_profile.php');
        break;

        
    case 'post_comment':
        if (isset($user_name) === false) :
            $user_name = '';
        endif;
        $view_user = $_SESSION["view_user"];

        $aerror = "Something went wrong adding the comment to the database...";
        $success = "Success comment added to " . $view_user . "'s profile.";

        $commentToAdd = filter_input(INPUT_POST, "commentToAdd", FILTER_VALIDATE_INT);
        $commentid = null;
        $profile = $view_user;
        if (isset($_SESSION["user_name"])) :
            $commenterProfile = $_SESSION["user_name"];
        endif;
        if (isset($commenterProfile) === false) :
            $commenterProfile = null;
        endif;
        $acomment = filter_input(INPUT_POST, 'acomment');

        $atimestamp = null;
        // Create the comment object
        $commentToAdd = new Comment($commentid, $profile, $commenterProfile, $acomment, $atimestamp);
        // Add the comment to the database
        if ($commentToAdd === false || $commentToAdd === null) {
            $error_message = "Something went wrong adding the comment to the database... <br> comment cannot be null";
            include('public_profile.php');
        } elseif ($profile === false || $profile === null || $profile === '' || $view_user === false || $view_user === null || $view_user === '' || $user_name === null || $user_name === false || $commenterProfile === null) {
            $error_message = "You need to login to preform this action...";
            include('public_profile.php');
        } elseif ($acomment === '') {
            $error_message = "You cannot leave a comment with nothing as a message...";
            include('public_profile.php');
        } elseif (strlen($acomment) > 2500) {
            $error_message = "Your comment is greater than 2,500 characters.";
            $acomment = filter_input(INPUT_POST, 'acomment');
            include('public_profile.php');
        } elseif ($profile === $commenterProfile) {
            $error_message = "You cannot leave a comment on your own profile...";
            include('public_profile.php');
        } else {
            // Add the comment to the database
            CommentDB::addComment($commentToAdd);
            $success = "Success comment added to " . $view_user . "'s profile.";
            header("Location: index.php?action=list_users&sucMessage");
            die();
            break;
        }
        break;

case "viewdelete":
    $profile = $_SESSION["user_name"];

    $a = '<p class="alert alert-success" role="alert" type="hidden" >';
    $b = '<p class="alert alert-danger" role="alert" type="hidden" >';
    $c = ' </p>';
    $errMessage = filter_input(INPUT_GET, "errMessage");
    $sucMessage = filter_input(INPUT_GET, "sucMessage");
    $aerror = "Bad ID, cannot be deleted";
    $success = "Success comment deleted";
    $comments = CommentDB::getbyprofile($profile);
    include('viewdelete.php');
    die();
    break;

    case "delete":
        $idToDelete = filter_input(INPUT_POST, "idToDelete", FILTER_VALIDATE_INT);

        if ($idToDelete === false || $idToDelete === null) {
            header("Location: index.php?action=viewdelete&errMessage");
            die();
        }
        Commentdb::deleteComment($idToDelete);
        header("Location: index.php?action=viewdelete&sucMessage");
        die();
        break;


        case "viewupdatecomment":
            $profile = $_SESSION["user_name"];
        
            $a = '<p class="alert alert-success" role="alert" type="hidden" >';
            $b = '<p class="alert alert-danger" role="alert" type="hidden" >';
            $c = ' </p>';
            $errMessage = filter_input(INPUT_GET, "errMessage");
            $sucMessage = filter_input(INPUT_GET, "sucMessage");
            $aerror = "Something went wrong, id could not be updated";
            $success = "Success comment updated";
            $comments = CommentDB::getbyprofile($profile);
            include('updateComment.php');
            die();
            break;

        case 'updateComment' :
            $idToUpdate = filter_input(INPUT_POST, "idToUpdate", FILTER_VALIDATE_INT);
            $newComment = filter_input(INPUT_POST, "acomment", FILTER_VALIDATE_INT);
            if ($idToUpdate === false || $idToUpdate === null || $idToUpdate === '' || $newComment === '' || $newComment === null || $newComment === false) {
                header("Location: index.php?action=viewupdatecomment&errMessage");
                die();
            }
            CommentDB::updateComment($idToUpdate, $newComment);
            header("Location: index.php?action=viewupdatecomment&sucMessage");
            die();
        break;
*/
    case 'home_index':        
        define('directAccess', TRUE);
        if (isset($_SESSION["user_name"])) :
            $profile = $_SESSION["user_name"];
            $comments = Commentdb::getbyprofile($profile);
        elseif (isset($user_name) === false) :
            $user_name = null;
        endif;
        if (strpos($_SERVER['REQUEST_URI'], 'user_manager') !== false) :
            $pathcor = "../";
        endif;
        include($pathcor . 'index.php');
        break;

    case 'about_index':
        define('directAccess', TRUE);
        if (isset($user_name) === true) :
            $user_name = $_SESSION["user_name"];
        elseif (isset($user_name) === false) :
            $user_name = null;
        endif;

        include('../about/index.php');
        break;
    default:
        $error = "Definitely, not suppose to be redirected here.";
        include('../errors/error.php');
        break;
}
