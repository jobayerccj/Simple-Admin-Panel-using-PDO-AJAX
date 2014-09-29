<?php
/*
 * 
 * Configuration for : Database Connection
 * This is the file where all the constants of database are saved.
 * Thanks 
 * 
 * 
 * */
 define("DB_HOST","localhost");
 define("DB_NAME","vpndb");
 define("DB_USER","jobayer");
 define("DB_PASSWORD","XTd98V7uwEZzLEhb");
 
 class Database
 {
		
	private $db_host = "localhost";  // Change as required
	private $db_user = "jobayer";  // Change as required
	private $db_pass = "XTd98V7uwEZzLEhb";  // Change as required
	private $db_name = "vpndb";	// Change as required
	
	/*
	 * Extra variables that are required by other function such as boolean con variable
	 */
	private $con = false; // Check to see if the connection is active
	private $result = array(); // Any results from a query will be stored here
    private $myQuery = "";// used for debugging process with SQL return
    private $numResults = "";// used for returning the number of rows
	
	// Function to make connection to database
	public function connect(){
		if(!$this->con){
			$myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);  // mysql_connect() with variables defined at the start of Database class
            if($myconn){
            	$seldb = @mysql_select_db($this->db_name,$myconn); // Credentials have been pass through mysql_connect() now select the database
                if($seldb){
					
                	$this->con = true;
                    return true;  // Connection has been made return TRUE
                }else{
                	array_push($this->result,mysql_error()); 
                    return false;  // Problem selecting database return FALSE
                }  
            }else{
            	array_push($this->result,mysql_error());
                return false; // Problem connecting return FALSE
            }  
        }else{  
            return true; // Connection has already been made return TRUE 
        }  	
	}
}
$database=new Database();
$database->connect();
 
?>
