
<?php
set_time_limit(0);
class database 
{
	var $mysqli = NULL;
	
	//Connect to the Specified Database
	function connect_database($server, $user, $password, $database)    {
   
		
       //create a connection to the database. Creates an instance of the pointer
       $this->mysqli = new mysqli($server, $user, $password, $database);

       //Check connection
       if ($this->mysqli->connect_error) {
           echo "Connection to the database failed: ".$this->mysqli->connect_error;	      
        }
        else {			
           return $this->mysqli;
         }
   }
   
   //Returns the connection to the database to the Specified Database. NB: if it is set add a return
   function get_DB_connection()    {
	   
		if (isset($this->mysqli)) {
   
			return $this->mysqli;       
		}
		else
		{
			echo "Error getting Database Connection </br>";
		}
   }
   
   
}

?>