<?php


?><header>
   <div id="header_container">
        <img src="images/instagram.png" alt="">
        <div id="header_right">
           <div id="search">
            <input type="text" placeholder="Search">
               
                   <?php if(isset($_SESSION['username'])){ ?> <a href="logout.php">Logout</a> <?php }else{ ?> <a href="login.php">Login</a> <?php } ?>
                </a>
        </div>
    </div>
</header>