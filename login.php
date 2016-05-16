<?php

    session_start();
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");


   if( !empty( $_POST ) ){
       $email = $_POST['email'];
       $password = $_POST['password'];
       $g = new User();
       if($g->canLogin( $email, $password ) ){
           $success = "Login succeeded, welcome!";
           
           $_SESSION['logged_in']=true;
           $_SESSION['email']=$email;

                      
            //SELECT USERNAME IPV EMAIL(van in SESSION) voor in de newsfeed bij posts
           /* $select2 = "SELECT username FROM user WHERE email='$email'";
            $sel_username = $conn->query($select2);   
            $fetch_sel_username=$sel_username->fetch();*/
            
    
            //$select3 = "SELECT id FROM user WHERE email='$email'";
            //$sel_id = $conn->query($select3);   
            //$fetch_sel_id=$sel_id->fetch();
           
           $_SESSION['username']=$g->selectUsername($email);
           $_SESSION['id']=$g->selectId($email);
           //$_SESSION['id']=
               //$statement3 = $conn->prepare("SELECT username FROM user WHERE username='$email'");
               //$_SESSION['username'] = $statement3->setFetchMode(PDO::FETCH_ASSOC);
               //echo $statement3;
               //$_SESSION['username'] = "jow"'
           echo "jow" . $_SESSION['username'];
           header('Location: newsfeed.php');
           $_SESSION['success'] = "logged in succesfully";
           
       }
       else{
           $error =  "Can not login!";
       }
   }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="container">
        <?php include_once('header.php'); ?>
        <main>
           


            <form action="" method="POST" id="login_form">
                <h1>Log in!</h1>
                <input type="text" placeholder="email" id="email" name="email"><br><br>

                <input type="password" placeholder="password" id="password" name="password"><br><br>
                
                <input type="submit" ><br><br>
                <a href="signup.php">Haven't got an account yet? <b>Sign Up!</b></a>
            </form>
        
            
            
        </main>
        <footer></footer>
    </div>
</body>
</html>