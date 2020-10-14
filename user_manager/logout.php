<?php 
$pathcor = "../";
include '../view/header.php'; ?>
   <main>
       <div id="form-wrapper" style="max-width:1000px;margin:auto;">
        <div class="row">
                <div class="large-12 columns">
                    <center><h1>You have been Logged Out</h1></center>
                </div>
        </div>   
     <form action="." method="post" >
        <p>
            <input type="hidden" name="action" value="login" >
            <input class="button" type="submit" value="Back to Login" ></p>
     </form>
       </div>
   </main>
<?php include '../view/footer.php'; ?>

