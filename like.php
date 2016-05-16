<?php

    include_once('classes/like.class.php');
    session_start();


if(isset($_GET['type'], $_GET['id'])){
    $type = $_GET['type'];
    $id = $_GET['id'];
    $id2 = $_SESSION['id'];
        
    $conn = Db::getInstance();
    $count_query2=$conn->query("SELECT COUNT(id) FROM likes WHERE userid = {$_SESSION['id']} AND postid = {$id}");
    $count_query2_result=$count_query2->fetch(PDO::FETCH_ASSOC);
    // antwoord = $count_query_result["COUNT(id)"]
    
    
    if($count_query2_result["COUNT(id)"]!=0){
        // delete this line in database!
        $conn = Db::getInstance();
        $del_query=$conn->query("DELETE FROM likes WHERE userid = {$_SESSION['id']} AND postid = {$id}");
    }
    else{
        $conn->query("INSERT INTO likes (userid, postid) SELECT {$_SESSION['id']}, {$id} FROM post WHERE NOT EXISTS (SELECT id FROM likes WHERE userid = {$_SESSION['id']} AND postid = {$id}) LIMIT 1");
    }
    
}

    



header('location:javascript://history.go(-1)');

?>