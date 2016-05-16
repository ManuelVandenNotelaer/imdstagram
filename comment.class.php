<?php

    include_once("db.class.php");

    class Comment
    {
        private $m_iUserid;
        private $m_iPostid;
        private $m_sText;

        
         //SET----------------------------------------
        public function __set($p_sProperty,$p_vValue)
        {
                switch($p_sProperty)
                {   
                    //Userid
                    case 'Userid':
                        $this->m_iUserid = $p_vValue; 
                        break;
                    
                    //Postid
                    case 'Postid':
                        $this->m_iPostid = $p_vValue; 
                        break;
                    
                    //Text
                    case 'Text':
                        $this->m_sText = $p_vValue; 
                        break;

                }
        }
        
        //GET----------------------------------------
        public function __get($p_sProperty)
        {
                switch($p_sProperty)
                {
                    case 'Userid':
                    return $this->m_iUserid;
                    break;
                    
                    case 'Postid':
                    return $this->m_iPostid;
                    break;
                    
                    case 'Text':
                    return $this->m_sText;
                    break;

                }
        }
        
        public function selectAll($id){
            $conn = Db::getInstance();
	        $comments = $conn->query("SELECT * FROM comment WHERE post_id=$id");
            //$comment=$select_comment->fetch(PDO::FETCH_ASSOC);
            return $comments;
        }
        
        
        //SAVE---------------------------------------
         public function save(){
         $conn = Db::getInstance();
         $statement = $conn->prepare("INSERT INTO comment(user_id,
                                                       post_id,
                                                       text
                                                       )

                                                VALUES(:userid,
                                                       :postid,
                                                       :text
                                                       )
                                       "); 

             $statement->bindValue(':userid',$this->Userid);
             $statement->bindValue(':postid',$this->Postid);
             $statement->bindValue(':text',$this->Text);
             $statement->execute();
             
        }
    }

?>