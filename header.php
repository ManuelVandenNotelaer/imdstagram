<?php



?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
    <script type="text/javascript">
        // DELETE Feedback
        /*$(document).ready(function(){
            $("#del_feedback").click(function(){
            //BUTTON WAS CLICKED
               document.getElementById("scs_feedback").remove();
                return(false);
            });
        });*/
    </script>
<header>
   <div id="header_container">
        <a href="newsfeed.php"><img src="images/instagram.png" alt=""></a>
        <div id="header_right">
           <div id="search">
           <form name="form1" method="post" action="searchresults.php" id="search_form">
                <input type="text" name="search" placeholder="Search">
           </form>
                <div id="header_loggedin_info">
                    <?php if(isset($_SESSION['email'])){ ?> <a href="profile.php">My Profile</a><?php } ?>

               

                   <?php if(isset($_SESSION['email'])){ ?> <a href="logout.php">Logout</a> <?php }else{ ?> <a href="login.php">Login</a> <?php } ?></a>
                </div>
        </div>
       
    </div
    
</header>
<div id="succes" style="background-color:lightgreen; width:67%; margin: 0 auto;">
    <?php
        if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
        }
    ?>  
    
</div>
<div id="error" style="background-color:lightcoral; width:67%; margin: 0 auto;">
    <?php
        if(isset($error)){
            echo $error;  
        }
        
    ?>
</div>