<?php

    include_once('classes/db.class.php');
    include_once('classes/post.class.php');
    include_once('classes/like.class.php');
    include_once('classes/comment.class.php');
    session_start();

    unset($_SESSION['limit']);
    
    
    $id = $_GET['id'];

    // WAT JE TE ZIEN KRIJGT IN NEWSFEED VAN DETAILPAGINA
    $p = new Post();
    $detail_post_result = ($p->selectAllForDetail($id));


    // COUNT LIKES
    $l = new Likes();
    $count_query_result = ($l->countLikes($id));


    //SAVE COMMENTS TO DATABSAE
    if(!empty($_POST['text'])){
        $c = new Comment();
        $c->Userid=$_SESSION['id'];
        $c->Postid=$id;
        $c->Text=$_POST['text'];
        $c->Save();
        $_SESSION['success'] = "Comment posted successfully!";
    }

    // SHOW COMMENTS
    $c = new Comment();
    $comments = ($c->selectAll($id));

    


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/style.css">
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
    <script type="text/javascript">
        /*$(document).ready(function(){
            $(".likebtn").click(function(){
            //BUTTON WAS CLICKED
                $.post("like.php")

                    //$(".likebtn").css('color', 'red');
                
                return(false);
            });
        });*/
    </script>
    
    
</head>
<body>
    <div id="container">
        <?php include_once('header.php'); ?>
        <main>


        
        <div id="newsfeed">
             <p style="padding-left:20px;"><?php echo $detail_post_result['username'];?></p> 
            <h3 style="padding-left:20px;"><?php echo htmlspecialchars($detail_post_result['description']);?></h3>
            <a href="detail.php?type=post&id=<?php echo $detail_post_result['id']; ?>"><img src="<?php echo $detail_post_result['photo'] ?>" style="width:70%; padding-left:20;"></a><br>
            <p style="padding-left:20px;"><?php echo $detail_post_result['upload_date'];?></p>
            <a href="like.php?type=post&id=<?php echo $detail_post_result['id']; ?>" class="likebtn">Like &#10084</a>
            <p>Total likes: <span style="color:red">&#10084</span> <?php echo $count_query_result["COUNT(id)"]; ?> </p>
        </div>
        
        <hr><br>
        <form action="" method="POST">
            <textarea rows="5" cols="80" placeholder="Post comment" name="text"></textarea>
            <input type="submit">
        </form>
        <br><hr><br>
        <?php
        while($comment = $comments->fetch(PDO::FETCH_ASSOC))
        {
            ?><div id="newsfeed_post"> 
                <!-- HIER MOET NORMAAL USERNAME KOMEN -->
                <h3 style="padding-left:20px;"><?php echo htmlspecialchars($comment['text']);?></h3>
                <hr>
            </div><br><?php
        }
     ?>  
        </main>
    </div><!-- end of container -->
</body>
</html>