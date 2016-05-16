<?php
    session_start();
    include_once('classes/user.class.php');
    include_once('classes/db.class.php');

    unset($_SESSION['limit']);

    // UPDATE PROFILE
    if(!empty($_POST['username'])){
        try{

            
            $old_username = $_SESSION['email'];
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $account_type = $_POST['account_type'];
            
            
            $g = new User();
            $g->update($username, $fullname, $email, $account_type, $old_username);
            
            //UPDATE USERNAME
            if(!empty($_POST['password'])){
                $g->updatePassword($old_username);  
            }
            
            
            //UPDATE PROFILE PIC
            if(isset($_FILES['image'])){
                  $errors= array();
                  $file_name = $_SESSION['email'] . "_" . $_FILES['image']['name'];
                  $file_size = $_FILES['image']['size'];
                  $file_tmp = $_FILES['image']['tmp_name'];
                  $file_type = $_FILES['image']['type'];
                  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                  $expensions= array("jpeg","jpg","png");

                  if(in_array($file_ext,$expensions)=== false){
                        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                  }

                  if($file_size > 2097152) {
                     $errors[]='File size must be excately 2 MB';
                  }

                  if(empty($errors)==true) {
                        move_uploaded_file($file_tmp,"images/profielfotos/".$file_name);
                        $_SESSION['success'] = "Succesfully updated profile picture.";

                      
                        $g = new User();
                        $g->updateProfilePic($old_username, $file_name);
                  }else{
                     // er moet niks gebeuren
                  }
                
            }
            $_SESSION['email'] = $_POST['email'];
            
        }
        catch(Exception $e){
            $error=$e->getMessage();
        }

    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript">
        function toggle_visibility(id){
            var e = document.getElementById(id);
            if(e.style.display == 'block'){
                e.style.display = 'none';
            }
            
            else{
                e.style.display = 'block'   
            }
            
        }
        
        
        $(document).ready(function(){
            $('#username').keyup(function(){
                 var username = $("#username").val();
                 console.log(username);
                
                
                 return(false);
                 document.getElementById('#username_availability_result').innerHTML = "checking..."; 
            });
        });
    </script>
          
        
   
</head>
<body>
    <div id="container">
        <?php include_once('header.php'); ?>
        
        <main>
        <!-- PROFIEL INFO GIDS ZELF -->
            <?php
                $g = new User();
                $all = $g->getAllInfo();
            
                while($line = $all->fetch(PDO::FETCH_ASSOC)){
                    if($_SESSION['email']==$line['email'])
                    {
                        $profile_pic = $line['profile_pic'];
                        ?> <img src="<?php echo $profile_pic ?>" alt="profile picture" id="profile_pic_update_1">
                        <?php 
                        echo "<b>Username:</b> ".$line['username'] . "<br>";
                        echo "<b>Fullname:</b> ".$line['fullname'] . "<br>";
                        echo "<b>Email:</b> ".$line['email'] . "<br>";
                        
                        echo "<b>Account Type:</b> ".$line['account_type'] . "<br>";                        
                    }
                }
            ?>
            <div id="popup-box1" class="popup-position">
               <div id="popup-wrapper">
                   <div id="popup-container">
                        <h2>Change your user info</h2><p><a href="javascript:void(0)" onclick="toggle_visibility('popup-box1');">Close</a></p>
                        <?php
                            $g = new User();
                            $all = $g->getAllInfo();
            
                            while($line = $all->fetch(PDO::FETCH_ASSOC)){
                                if($_SESSION['email']==$line['email']){
                                    ?><form method="POST" name="update" enctype = "multipart/form-data"><?php
                                    
                                        $profile_pic = $line['profile_pic'];
                                        ?> <div ><img src="<?php echo $profile_pic ?>" alt="profile picture" id="profile_pic_update_2"></div>
                                        <div id="profile_update_info">
                                        <?php echo "<b>Profile pic:</b>"?><br>
                                        <input type="file" name="image" id="fileToUpload"><br>
                                        
                                        
                                        <?php 
                                        echo "<b>Username:</b> "?><br><input type="text" value="<?php echo $line['username'];?>" id="username" name="username" onblur="checkusername()"><span id="username_availability_result"></span><br><br><?php
                                        echo "<b>Fullname:</b> "?><br><input type="text" value="<?php echo $line['fullname']; ?>" id="fullname" name="fullname"><br><br><?php
                                        echo "<b>Email:</b> ";?><br><input type="text" value="<?php echo $line['email'] ?>" id="email" name="email"><br><br><?php
                                        
                                        echo "<b>Account Type:</b> ";?><br><select name="account_type">
  <option value="private">Private</option>
                       <option value="public">Public</option></select><br><br><?php
                                        echo "<b>Password:</b> "?><input type="password" value="" id="password" name="password"><br><?php
                                        ?><input type="submit">
                                            </div><!-- end of profile update info -->
                                    </form><?php
                                }
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
            
            <div id="wrapper">
                <p><a href="javascript:void(0)" onclick="toggle_visibility('popup-box1');">Change Your user info</a></p>
            </div>
        </main>
        
    </div><!-- end of container -->
</body>
</html>