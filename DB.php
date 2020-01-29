<?php
class DB {
    public static $con;
    public function __construct() {

        $mysqli = new mysqli("localhost","root","","sign-in");
        
        // Check connection
        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }  
        self::$con = $mysqli; 
    }

    public static function getConnection() {
        if (self::$con == null) {
            self::$con = new DB();
        } 
        return self::$con;
    } 

    public function insert($data, $table) {  
        $query = "INSERT INTO ".$table." (name, email, password, image, hobbies) VALUES( '". $data['name']."','". $data['email']."','". md5($data['password'])."','". $data['image']."','". json_encode($data['hobbies'])."')";
        if(self::$con->query($query)) {
            return true;
        }
        return false;
    }

    public function delete($data, $table) {
        $query = "DELETE FROM ".$table."";
        
        if(isset($data['id']) && !empty($data['id'])) {
            $query .= " WHERE id =". (int) $data['id']."";
        }
        if(self::$con->query($query)) {
            return true;
        }
        return false;       
    }

    public function edit($data, $table) {
        $query = "DELETE FROM ".$table." WHERE id =". (int) $data['id']."";
        self::$con->query($query);
        $query = "INSERT INTO ".$table." (name, email, password, image, hobbies) VALUES( '". $data['name']."','". $data['email']."','". $data['password']."','". $data['image']."','". json_encode($data['hobbies'])."')";
        if(self::$con->query($query)) {
            return true;
        }   
        return false;
    }

    public function getData($data, $table) {
        $query = "SELECT * FROM ".$table."";
        $result = self::$con->query($query);
        return $result;
    }
}










?>