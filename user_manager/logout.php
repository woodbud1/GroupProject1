<?php 
$the_title = "MathWiz | Logout";
$pathcor = "./";
include './view/header.php'; ?>
   <main>
       <div class="box">
        <div class="row">
                <div class="large-12 columns">
                    <h1 style="color:black">You have been Logged Out</h1>
                </div>
        </div>   
     <form action="." method="post" >
        <p>
            <input type="hidden" name="action" value="login_initial" >
            <input class="button" type="submit" value="Back to Login" ></p>
     </form>
       </div>
   </main>
<?php include './view/footer.php'; ?>

