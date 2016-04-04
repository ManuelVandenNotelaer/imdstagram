<?php

if(!empty($_POST)){
if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['fullname']) && !empty($_POST['password'])){
        $conn = new mysqli("localhost", "root", "root", "imdstagram");
        
        $email = $_POST['email'];
        
        $options = [
            'cost' => 12
        ]; 
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        
        $query = "insert into user (email, password, username, fullname) values ('".$conn->real_escape_string($email)."', '$password', '$username', '$fullname');";
        if($conn->query($query)){
            $success = "Welcome aboard!";       
        }
        else{
            $error = "Invalid username or password, please try again!";
        }
    }
else{
    $error = "All fields are required, please try again!";
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
           <h1>Sign Up Here!</h1>
           <?php if(isset($success)){
                echo "<p class='message'>$success</p>";
            }  
          ?>
            <?php if(isset($error)){
                echo "<p class='error'>$error</p>";
            }?>
            <form method="POST">
                <input type="text" placeholder="Username" id="username" name="username"><br>
                <input type="text" placeholder="email" id="email" name="email"><br>
                <input type="text" placeholder="fullname" id="fullname" name="fullname"><br>
                <input type="password" placeholder="password" id="password" name="password"><br>
                <input type="submit">
            </form>
            
        </main>
        <footer></footer>
    </div>
</body>
</html>