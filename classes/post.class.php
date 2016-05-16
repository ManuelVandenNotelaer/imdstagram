<?php

    include_once("db.class.php");

    class Post
    {
        private $m_iUsername;
        private $m_sPhoto;
        private $m_sDescription;
        private $m_sDate;
        private $m_sLocation;
        
         //SET----------------------------------------
        public function __set($p_sProperty,$p_vValue)
        {
                switch($p_sProperty)
                {
                    //USERID
                    case 'Username':
                     
                        $this->m_iUsername = $p_vValue; 
                        break;
                    
                    //PHOTO
                    case 'Photo':
                        $this->m_sPhoto = $p_vValue; 
                        break;
                    
                    //DESCRIPTION
                    case 'Description':
                        $this->m_sDescription = $p_vValue; 
                        break;
                    
                    //DATE
                    case 'Date':
                        $this->m_sDate = $p_vValue; 
                        break;
                    
                    //LOCATION
                    case 'Location':
                        $this->m_sLocation = $p_vValue; 
                        break;
                }
        }
        
        //GET----------------------------------------
        public function __get($p_sProperty)
        {
                switch($p_sProperty)
                {
                    case 'Username':
                    return $this->m_iUsername;
                    break;
                    
                    case 'Photo':
                    return $this->m_sPhoto;
                    break;
                    
                    case 'Description':
                    return $this->m_sDescription;
                    break;
                    
                    case 'Date':
                    return $this->m_sDate;
                    break;
                    
                    case 'Location':
                    return $this->m_sLocation;
                    break;
                }
        }
        
        public function selectAll(){ // for newsfeed
                
            if(!isset($_SESSION['limit'])){
                $_SESSION['limit']=20;
            }

            if(isset($_POST['btn'])){
                $_SESSION['limit']=$_SESSION['limit']+20;
            }
            $conn = Db::getInstance();
            $limit = $_SESSION['limit'];
            $select = "SELECT * FROM post ORDER BY upload_date DESC LIMIT $limit";
	        $posts = $conn->query($select);
            return $posts;
        }
        
        
        public function selectAllForDetail($id){ // for newsfeed

            $conn = Db::getInstance();
            $detail_post = $conn->query("SELECT * FROM post WHERE id = $id");
            $detail_post_result=$detail_post->fetch(PDO::FETCH_ASSOC);
            //var_dump($detail_post_result);
            return $detail_post_result;
        }
                
        
        public function searchFunction(){ 
            $conn = Db::getInstance();
            $search_sql="SELECT * FROM post WHERE description LIKE '%".$_POST['search']."%' ORDER BY upload_date DESC";
            $search_query=$conn->query($search_sql);
            $nRows = $conn->query("SELECT * FROM post WHERE description LIKE '%".$_POST['search']."%' ORDER BY upload_date DESC")->fetchColumn();
            
            return $nRows;
        }
        
        //SAVE---------------------------------------
         public function save(){
         $conn = Db::getInstance();
         $statement = $conn->prepare("INSERT INTO post(username,
                                                       photo,
                                                       description,
                                                       upload_date,
                                                       location
                                                       )

                                                VALUES(:username,
                                                       :photo,
                                                       :description,
                                                       :upload_date,
                                                       :location
                                                       )
                                       "); 

             $statement->bindValue(':username',$this->Username);
             $statement->bindValue(':photo',$this->Photo);
             $statement->bindValue(':description',$this->Description);
             $statement->bindValue(':upload_date',$this->Date);
             $statement->bindValue(':location',$this->Location);
             $statement->execute();
             
        }
    }

?>