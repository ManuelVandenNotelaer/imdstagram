<?php
    session_start();
    include_once('classes/db.class.php');
    include_once('classes/post.class.php');
    

    unset($_SESSION['limit']);


    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }


// SEARCH FUNCTIE
if(!isset($_POST['search'])){
    header("Location:index.php");
}

    $p = new Post();
    $nRows = ($p->searchFunction());
    if($nRows!=0){
      
        
        $conn = Db::getInstance();
            $search_sql="SELECT * FROM post WHERE description LIKE '%".$_POST['search']."%' ORDER BY upload_date DESC";
            $search_query=$conn->query($search_sql);
            $nRows = $conn->query("SELECT * FROM post WHERE description LIKE '%".$_POST['search']."%' ORDER BY upload_date DESC")->fetchColumn();
        
          $search_rs=$search_query->fetch(PDO::FETCH_ASSOC);
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
</head>
<body>
    <div id="container">
        <?php include_once('header.php'); ?>
        <main>    


    <h1>Search results</h1>
            <?php if($nRows!=0){
                    do { ?>
     <div id="newsfeed_post">
            <p style="padding-left:20px;"><?php echo $search_rs['username'];?></p>
         <h3 style="padding-left:20px;"><?php echo htmlspecialchars($search_rs['description']);?></h3>
         <a href="detail.php?type=post&id=<?php echo $search_rs['id']; ?>"><img src="<?php echo $search_rs['photo'] ?>" style="width:70%; padding-left:20px;"></a><br>
         <p style="padding-left:20px;"><?php echo $search_rs['upload_date'];?></p>

            <hr>
        </div>                  
<?php }while ($search_rs=$search_query->fetch(PDO::FETCH_ASSOC));
                } else{
                    echo "no results found";
                }
?>






        </main>
        
        
        
    </div><!-- end of container -->
</body>
</html>