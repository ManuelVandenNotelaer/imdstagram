<?php

    session_start();

function canLogin($p_email, $p_password ){

        
        $conn = new mysqli("localhost", "root", "", "imdstagram");
        $query = " SELECT * FROM user 
                    WHERE email = '".$conn->real_escape_string($p_email)."'";
        
        $result = $conn->query($query);
        if($result->num_rows == 1){
            $user = $result->fetch_assoc(); 
            if(password_verify( $p_password, $user['password'])){
                return true;   
            }
            else{
                return false;   
            }
        }
        else{
            return false;   
        }


   }

   if( !empty( $_POST ) ){
       $email = $_POST['email'];
       $password = $_POST['password'];
       if( canLogin( $email, $password ) ){
           $success = "Login succeeded, welcome!";
           
           $_SESSION['logged_in']=true;
           $_SESSION['username']=$email;
           
       }
       else{
           $error =  "Woops, cannot login.";
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
           <h1>Log in!</h1>
            <?php if(isset($success)){
                echo "<p class='message'>$success</p>";
            }  
          ?>
            <?php if(isset($error)){
                echo "<p class='error'>$error</p>";
            }?>
            <form method="POST">
                <input type="text" placeholder="email" id="email" name="email"><br>
                <input type="password" placeholder="password" id="password" name="password"><br>
                
                <input type="submit">
            </form>
        
            <a href="signup.php">Signup</a>
            
        </main>
        <footer></footer>
    </div>
</body>
</html>