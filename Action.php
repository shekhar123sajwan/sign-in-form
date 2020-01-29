<?php 
require_once('DB.php');
class Action{  
   protected $model ;
   public $errors = [];
    public function getModel() {
        if($this->model == null ) {  
          $this->model = new DB();
        }
        return $this->model;
    }
    public function saveAction($data) {  
      
        $data = $_POST; 
        if($this->validate($_POST, $_FILES)) { 
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name']; 
                $uploads_dir = 'uploads'; 
                $tmp_name = $_FILES["image"]["tmp_name"]; 
                $name = basename($_FILES["image"]["name"]);
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
            }  
            $this->getModel()->insert($data, 'user');
            header("Location: users.php"); 
            exit();
        } 
        $data['errors'] = $this->errors; 
        return $data;
    }

    public function editAction($data) {
      $this->getModel()->edit($data, 'user');
    }
    
    public function getUsers() {
      $data = [];
      return $this->getModel()->getData($data , 'user');
    }

    public function getUserById($id) {
      $this->getModel()->getUserByID($id, 'user');
    }    

    public function validate($data, $files=[]) {
      foreach($data as $key => $value) {
          if(empty($data[$key])) { 
            $this->errors[] = $key." is not valid";
          }
      }
      if(!isset($data['hobbies']) || empty($data['hobbies'])) { 
        $this->errors[] = "Tick Hobbies";
      }

      if(count($files) > 0) {
        if(!isset($files['image']['name']) || empty($files['image']['name']))
        $this->errors[] = 'Please enter valid file format';
      } 
      if(count($this->errors) > 0) {
          return false;
      }
      return true;
    }
}








?>