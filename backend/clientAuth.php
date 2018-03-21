<?php
class loginDB
{
    private $db;
    private $salt;
    
    public function connect($iniFile)
    {
        $ini = parse_ini_file
        $this->db = new mysqli(
        $ini['authDB']['localhost'],
        $ini['authDB']['root'],
        $ini['authDB']['july161996'],
        $ini['authDB']['IT490Project']);// These would change with the database credentials
        
        $this->salt = $ini['authDB']['salt'];
        
        if ($this->db->connect_errno > 0)
	  {
            echo __FILE__.__LINE__."failed to connect to database re:".$this->db->connect_error.PHP_EOL;
            exit(0);
	  }
	  
      }
    
    public function destruct()
    {
        $this->db->close()
    }
    
    public function fetchQuery($name)
    {
        $query = "select * from users where where userName='$name';";//This would change with the database column names
        $results = $this->db->query($query);
        if(!$results)
        {
            echo "error with results : ".$this.db.error.PHP_EOL;
            return 0;
        }
        $user = $results->fetch_assoc();
        if (isset($user['username']))
    
        return $user['username'];
    }
        
      private function saltPassword($password)
      {
	  return $this->db->real_escape_string(sha1($password.$this->salt));
      }
      
      public function validateClient($name,$passwod)
      {
	  if ($this->fetchQuery($name) == 0)
	  {
	      return array("success"=>false,"message"=>"user does not exist!")
	  }
	  $query = "select * from users where userName='$name';";
	  $results = $this->db->query($query);
	  if (!results)
	      {
		  echo "wrong".PHP_EOL;
		  return array("success"=>false,"message"=>"db failure")
	      }
	      
	  $client = $results->fetch_assoc();
	  {
	  if ($user['password'] == $this->saltPassword($password)
	      {
		  return array ("success"=>true);
	      }
	  }
	  return array("success"=>false,"message"=>"failed to match password");
      }
     
      public function addNewClient($name,$password)
      {
	  if ($this->fetchQuery($name) != 0)
	  {
	      echo " user $name already exist.".PHP_EOL;
	      $response = array("message"=>"user $name already exist","success"=>false);
	      return $response;
	  }
	  
	  if (!$results)
	  
	  {
	     echo "error: ".$this->db->error.PHP_EOL;
	  }
	  return array("success"=>true);
        }

}





?>