<?php

    class Db{
        private static $db;
        // static =  $conn = Db::getConnection(); zo roep je nu aan ipv "new Db" te moeten aanmaken, anders maak je dit 100x in 1 project
        
        public static function getConnection(){
            
            if( is_null(self::$db)){ // self is min of meer hetzelfde als $this
                self:$db = new PDO("mysql:localhost;dbname=imdstagram", "root","");
            }
            
            return self::$db;
            
            
        }
    }

?>