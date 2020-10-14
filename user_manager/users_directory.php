<!-- set per page -->
<?php
$the_title = "MathWiz | User Directory";
$pathcor = "./";
require_once './view/header.php';
if (isset($_SESSION["view_user"])) :
    $view_user = $_SESSION["view_user"];
    $profile = $view_user;
endif;
//if (isset(($_SESSION["user_name"]))) :
    $commenterProfile = $_SESSION["user_name"];
//else :
    $view_user = '';
//endif;
?>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <!-- Head -->
                <thead class="mdb-color darken-2">
                    <tr class="text-white" id="top-directory">
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Profile</th>
                    </tr>
                </thead>

                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->getFullName(), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->getUsername(), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </thead>
        </table>
    </div>
</div>
<?php require_once './view/footer.php'; ?>