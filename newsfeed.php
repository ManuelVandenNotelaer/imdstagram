<?php

    include_once('classes/db.class.php');
    include_once('classes/post.class.php');
    include_once('classes/like.class.php');

    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }

    if(!empty($_POST['description'])){
        
        //POST POST
            if(isset($_FILES['fileToUpload'])){
                 $now = new DateTime();
                 $time = $now->format('YmdHis'); 
                
                  $errors= array();
                  //$file_name = $_SESSION['id'] . "_" . $time;
                  $file_name = $_SESSION['id'] . $time;
                  $file_size = $_FILES['fileToUpload']['size'];
                  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
                  $file_type = $_FILES['fileToUpload']['type'];
                  $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
                  $expensions= array("jpeg","jpg","png");

                  if(in_array($file_ext,$expensions)=== false){
                        $error="Extension not allowed, please choose a JPEG or PNG file.";
                  }

                  if($file_size > 2097152) {
                     $errors[]='File size must be less than 2 MB';
                  }

                  if(empty($errors)==true) {
                     move_uploaded_file($file_tmp,"images/posts/".$file_name);
                     // $success = ...

                    $p = new Post();
                    $p->Username=$_SESSION['username'];
                    $p->Photo="images/posts/$file_name";
                    $p->Description=$_POST['description'];
                        $now = new DateTime();
                        $time = $now->format('Y-m-d H:i:s'); 
                    $p->Date=$time;
                    $p->Location="test";
                    $p->save();
                    $_SESSION['success'] = "Posted succesfully!";
                      
                  }else{
                     print_r($errors);
                  }  
           }
    }
    else{
        $serror = "Fill in description!";
    }


    // WAT JE TE ZIEN KRIJGT IN NEWSFEED
    $p = new Post();
    $posts = ($p->selectAll());


   
    
    if(isset($_GET['delete_btn']))
    {
        echo "hoera";
        //$conn = Db::getInstance();
        //$delete = "DELETE * FROM post WHERE upload_date =... ";
	    //$delete_q = $conn->query($delete);
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function change();
            {
                <?php $limit=$limit+20; 
                    echo $limit;
                ?>
            }
    </script>
    <!--<script src="jquery.min.js" type="text/javascript"></script>
    <script src="jquery.timeago.js" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
          jQuery("time.timeago").timeago();
        });
    </script>-->
   
</head>
<body>
    <div id="container">
        <?php include_once('header.php'); ?>
        <main>
            <form action="" method="post" id="post_form" enctype="multipart/form-data">
                <h2>Post update:</h2>
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <textarea name="description" rows="6" cols="50" id="description" placeholder="Description"></textarea><br><br>
                
                <input type="submit" value="Send" name="submit">
                <br><br>
            </form>
            <?php

	while($post = $posts->fetch(PDO::FETCH_ASSOC))
	{
        ?><div class="newsfeed_post"> <!--<a href="#" style="float:right;">Delete</a>-->
            <?php if($post['username']===$_SESSION['username']){ ?>
        <!--<form method="get">
            <input type="hidden" name="delete_btn">
            <input type="submit" value="Delete" style="float:right;">
        </form>-->
            <?php } ?>
            <p style="padding-left:20px;"><?php echo $post['username'];?></p> 
            <h3 style="padding-left:20px;"><?php echo $post['description'];?></h3>
            <a href="detail.php?type=post&id=<?php echo $post['id']; ?>"><img src="<?php echo $post['photo'] ?>" style="width:70%; padding-left:20;"></a><br>
            <p style="padding-left:20px;"><?php echo $post['upload_date'];?></p>

            

            <hr>
        </div><br><?php
	}
    ?>      <form action ="" method = "POST">
                <input type="submit" value="Load 20 more posts" name="btn">
            </form>
        </main>
        
        
        
    </div><!-- end of container -->
</body>
</html>