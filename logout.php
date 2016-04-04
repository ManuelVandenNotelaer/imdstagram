<?php

    //setcookie("loggedin", "", time()-3600);
    session_start();
    session_destroy();
    header('location: login.php');

?>