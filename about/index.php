<?php
$the_title = "MathWiz | About";
$pathcor = "../";
' if (!defined('directAccess')) :
    echo 'Direct access not permitted';
    header("Location: ../user_manager/?action=about_index");
    die();
endif; '
require_once '../view/header.php';
if(isset($user_name)) :
$_SESSION["user_name"] = $user_name;
endif;
?>
<h2></h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas molestie nulla ligula, sit amet imperdiet nisi aliquet id.
    Curabitur sed sem est. In ut nisl egestas odio interdum pellentesque eu nec est. Suspendisse vitae pharetra mi.
    Morbi eget nisl lacus. Mauris eu ligula turpis. Integer eget tincidunt massa.</p>
<p>Integer feugiat nisi quis lectus laoreet iaculis. Integer volutpat auctor tristique.
    Vestibulum varius, sem ac bibendum tincidunt, turpis mi fringilla elit, at pharetra felis sapien at ligula.
    Curabitur pharetra, ante et volutpat scelerisque, ligula nibh semper nibh, ac lobortis diam neque nec ligula.
    Donec elementum massa ex, non sodales arcu mattis et. Cras eget turpis libero.
    Cras interdum viverra purus, at hendrerit massa porta et. Integer orci ipsum, pretium quis tristique eu, aliquam eu eros.
    Etiam neque dui, euismod nec ante sed, vestibulum tempus nisl. Proin mattis ornare magna eget rhoncus.
    Ut placerat dolor ut orci feugiat, vel vehicula ex viverra. Mauris vel est felis.
    Pellentesque pharetra mauris diam, at lobortis metus faucibus at. Vestibulum vitae lobortis elit.</p>
<p>Mauris non pellentesque ligula. Curabitur maximus, urna a ultrices tristique, nisl massa pellentesque massa, a
    varius arcu ante vel dui. Phasellus ac egestas felis. Nunc egestas sapien in nisi sollicitudin molestie. Sed bibendum
    tellus diam, ac porta tortor volutpat sit amet. Mauris ex leo, tempor ut dolor bibendum, ultrices mattis velit.
    Aliquam ornare ullamcorper placerat. Vestibulum sed dapibus justo, vel iaculis risus. Integer eget rhoncus lorem.
    Nunc vel ante at enim interdum rhoncus. Curabitur malesuada ligula elit, vitae bibendum ante malesuada interdum.
    Aenean in hendrerit neque. In hac habitasse platea dictumst. Donec mollis tincidunt ultrices.
    Nam egestas dapibus leo pellentesque consectetur. Nunc a ante et arcu suscipit sollicitudin sed et nunc.</p>
<?php require_once '../view/footer.php'; ?>