<?php

    include_once("db.class.php");

    class Likes
    {
        private $m_iPostid;
        private $m_iUserid;

        
         //SET----------------------------------------
        public function __set($p_sProperty,$p_vValue)
        {
                switch($p_sProperty)
                {
                    //Postid
                    case 'Postid':
                     
                        $this->m_iPostid = $p_vValue; 
                        break;
                    
                    //Userid
                    case 'Userid':
                        $this->m_iUserid = $p_vValue; 
                        break;

                }
        }
        
        //GET----------------------------------------
        public function __get($p_sProperty)
        {
                switch($p_sProperty)
                {
                    case 'Postid':
                    return $this->m_iPostid;
                    break;
                    
                    case 'Userid':
                    return $this->m_iUserid;
                    break;

                }
        }
        
        public function countLikes($id){
             $conn = Db::getInstance();
             $count_query = $conn->query("SELECT COUNT(id) FROM likes WHERE postid=$id;");
             $count_query_result=$count_query->fetch(PDO::FETCH_ASSOC);
             //var_dump($detail_post_result);
             return $count_query_result;
        }
        
        //SAVE---------------------------------------
         public function save(){
         $conn = Db::getInstance();
         $statement = $conn->prepare("INSERT INTO likes(postid,
                                                       userid
                                                       )

                                                VALUES(:postid,
                                                       :userid
                                                       )
                                       "); 

             $statement->bindValue(':postid',$this->Postid);
             $statement->bindValue(':userid',$this->Userid);
             $statement->execute();
             
        }
    }

?>