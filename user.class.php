<?php
    
        include_once("db.class.php");


    class User
    {
        private $m_sUsername;
        private $m_sEmail;
        private $m_sFullname;
        private $m_sPassword;
        private $m_sAccount_type;
        private $m_sProfile_pic;
        

        //SET----------------------------------------
        public function __set($p_sProperty,$p_vValue)
        {
                switch($p_sProperty)
                {
                    //NAAM
                    case 'Username':
                    if($p_vValue!="")
                    {
                        $this->m_sUsername = $p_vValue; 
                    }
                    else
                    {
                        throw new Exception("<b>Username niet ingevuld."); 
                    }
                    break;


                    //E-MAILADRES
                    case 'Email':
                    if ($p_vValue!="")
                    {
                        if($this->checkEmail($p_vValue) === true)
                        {
                            $this->m_sEmail = $p_vValue;
                        }
                        else
                        {
                            throw new Exception("<b>E-mailadres is al in gebruik!</b> Probeer opnieuw met een ander e-mailadres.");
                        }
                    }
                    else
                    {
                        throw new Exception("<b>E-mailadres is niet ingevuld!</b> Alle verplichte velden moeten ingevuld zijn.");
                    }
                    break;
                    
                    
                    //FULLNAME
                    case 'Fullname':
                    if ($p_vValue!="")
                    {
                            $this->m_sFullname = $p_vValue;
                        
                    }
                    else
                    {
                        throw new Exception("<b>Fullname is niet ingevuld!");
                    }
                    break;

                    
                    //PASSWORD
                    case 'Password':
                    if($p_vValue!="")
                    {
                        $options=['cost'=>12,];
                        $this->m_sPassword = password_hash($p_vValue,PASSWORD_BCRYPT, $options);
                    }
                    else
                    {
                        throw new Exception("<b>Wachtwoord is niet ingevuld!</b> Alle verplichte velden moeten ingevuld zijn.");     
                    }
                    break;
                    
                    
                    //ACCOUNT_TYPE
                    case 'Account_type':
                        $this->m_sAccount_type = $p_vValue;
                    break;
                    
                    
                    //PROFILE_PIC
                    case 'Profile_pic':
                        $this->m_sProfile_pic = $p_vValue;
                    break;
                    


                }
        }

        //GET----------------------------------------
        public function __get($p_sProperty)
        {
                switch($p_sProperty)
                {
                    case 'Username':
                    return $this->m_sUsername;
                    break;

                    case 'Email':
                    return $this->m_sEmail;
                    break;
                    
                    case 'Fullname':
                    return $this->m_sFullname;
                    break;

                    case 'Password':
                    return $this->m_sPassword;
                    break;
                    
                    case 'Account_type':
                    return $this->m_sAccount_type;
                    break;
                    
                    case 'Profile_pic':
                    return $this->m_sProfile_pic;
                    break;
                    


                }
        }
        
        //CHECK OF E-MAILADRES AL BESTAAT 
        public function checkEmail($m_sEmail)
        {
            $ret = true;
            $all_mails = $this->getAllInfo();
            while($row = $all_mails->fetch(PDO::FETCH_ASSOC)) {
                if($row['email'] == $m_sEmail)
                {
                    $ret = false;
                }
            }
            return $ret;
        }
        
        
        //GET ALL INFO-----------------------------------
        public function getAllInfo()
        {
            $conn = Db::getInstance();
            $allInfo = $conn->query("SELECT * FROM user");
            return $allInfo;
        }
        
        
        // LOGIN
        public function canLogin($p_email, $p_password){
            $conn = Db::getInstance();
            try{
                $post = $conn->prepare("SELECT * FROM user WHERE email = ?");
                $post->execute(array($_POST['email']));
                $row = $post->fetch(PDO::FETCH_ASSOC);
                if (password_verify($p_password, $row['password'])){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $e){
                    $error = $e->getMessage();
            }
        }
        
        //SELECT USERNAME IPV EMAIL(om in de Session te putten)
        public function selectUsername($email){
            $conn = Db::getInstance();
            $select2 = "SELECT username FROM user WHERE email='$email'";
            $sel_username = $conn->query($select2);   
            $fetch_sel_username=$sel_username->fetch();
            return $fetch_sel_username[0];
        }
        
        //SELECT USERNAME IPV ID(om bij de comments te putten)
        public function selectUsernameipvid($comment_poster_id){
            $conn = Db::getInstance();
            $select2 = "SELECT username FROM user WHERE id='$comment_poster_id'";
            $sel_username = $conn->query($select2);   
            $fetch_sel_username=$sel_username->fetch();
            return $fetch_sel_username[0];
        }
        
        //SELECT ID IPV EMAIL(om in de Session te putten)
        public function selectId($email){
            $conn = Db::getInstance();
            $select3 = "SELECT id FROM user WHERE email='$email'";
            $sel_id = $conn->query($select3);   
            $fetch_sel_id=$sel_id->fetch();
            return $fetch_sel_id[0];
        }
        
        
        // UPDATE 
        public function update($username, $fullname, $email, $account_type, $old_username){
            $conn = Db::getInstance();            
            $statement = $conn->prepare("UPDATE user SET username='$username',
                                                         fullname='$fullname',
                                                         email='$email',
                                                         account_type='$account_type'
            
            WHERE email='$old_username'");
            $statement->execute();
        }
        
        
        // UPDATE PASSWORD
        public function updatePassword($old_username){
            $conn = Db::getInstance();
            $options=['cost'=>12,];
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT, $options);
            $statement2 = $conn->prepare("UPDATE user SET password='$password' WHERE email='$old_username'");
            $statement2->execute();
        }
        
        
        //UPDATE PROFILE PICTURE
        public function updateProfilePic($old_username, $file_name){
             $conn = Db::getInstance();
                        $statement3 = $conn->prepare("UPDATE user SET profile_pic='images/profielfotos/$file_name'
                        WHERE email='$old_username'");
                        $statement3->execute();
        }
        

         //SAVE---------------------------------------
         public function save(){
         $conn = Db::getInstance();
         $statement = $conn->prepare("INSERT INTO user(username,
                                                       email,
                                                       fullname,
                                                       password,
                                                       account_type,
                                                       profile_pic
                                                       )

                                                VALUES(:username,
                                                       :email,
                                                       :fullname,
                                                       :password,
                                                       :account_type,
                                                       :profile_pic
                                                       )
                                       "); 

             $statement->bindValue(':username',$this->Username);
             $statement->bindValue(':email',$this->Email);
             $statement->bindValue(':fullname',$this->Fullname);
             $statement->bindValue(':password',$this->Password);
             $statement->bindValue(':account_type',$this->Account_type);
             $statement->bindValue(':profile_pic',$this->Profile_pic);
             $statement->execute();
             
        }
    }
?>