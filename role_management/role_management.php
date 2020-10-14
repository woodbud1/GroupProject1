<?php
$the_title = "MathWiz | Role Management";
$pathcor = "../";
require_once '../view/header.php';
if (isset($_SESSION["view_user"])) :
    $view_user = $_SESSION["view_user"];
    $profile = $view_user;
endif;
?>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-hover">
                <thead class="mdb-color darken-2">
                    <tr>
                        <th>Role ID</th>
                        <th>Role Name</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach ($roles as $role) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($role->getRoleID(), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($role->getRoleName(), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    <form action="." method="post" id="role">
        <input class="button" type="submit" name="action" value="Add Role" >
        <input class="button" type="submit" name="action" value="Edit Role">
    </form>
<?php require_once '../view/footer.php'; ?>
