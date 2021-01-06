<?php 
class database{
 public $host   = DB_HOST;
 public $user   = DB_USER;
 public $pass   = DB_PASS;
 public $dbname = DB_NAME;

    public $link;
    public $error;

    function __construct(){

        $this->database();
    }
     
    private function database(){

        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if($this->link){
           echo "Connection sucessfull";
        }
    }

    public function insert($data){
        $insert_row   = $this->link->query($data) or die ($this->link->error.__LINE__);
        if($insert_row ){
            return $insert_row;
        }else {
            return false;
        }
    }

    public function select($data){
        $result = $this->link->query($data) or die ($this->link->error.__LINE__);
        if($result){
            return $result;
        }else {
            return false;
        }
    }

    public function delete($data){
        $delete = $this->link->query($data) or die ($this->link->error.__LINE__);
        if($delete){
            return $delete;
        }else{
            return false;
        }
    }
}

?>