<?php


    include_once('classes/user.class.php');
	session_start();

if(!empty($_POST)){
    if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['fullname']) && !empty($_POST['password'])){
            try
            {       
                $g = new User();
                $g->Username=$_POST['username'];
                $g->Email=$_POST['email'];
                $g->Fullname=$_POST['fullname'];
                $g->Password = $_POST['password'];
                $g->Account_type = 'private';
                $g->Profile_pic = 'images/profielfotos/default_profile_pic.jpg';
                $g->save();
                $_SESSION['success'] = "Your account hes been created succesfully!";
                header("location:login.php"); //to redirect 
            }

            catch(Exception $e)
            {
                $error=$e->getMessage();
            }
        }
    else{
        $error = "All fields are required, please try again!";
    }

    session_start();
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
           

            <form method="POST" id="signup_form">
               <h1>Sign Up Here!</h1>
                <input type="text" placeholder="Username" id="username" name="username"><br><br>
                <input type="text" placeholder="email" id="email" name="email"><br><br>
                <input type="text" placeholder="fullname" id="fullname" name="fullname"><br><br>
                <input type="password" placeholder="password" id="password" name="password"><br><br>
                <input type="submit"><br><br>
            </form>
            
        </main>
        <footer></footer>
    </div>
</body>
</html>