<?php

class DB {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "ASP";
	public $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
}
abstract class User{
    public $firstname;
    public $lastname;
    public $Email;
    public $password;
    public $role;
    public $roleID;

    function __construct($firstname,$lastname,$Email,$password,$role,$roleID){
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->Email=$Email;
        $this->password=$password;
        $this->role=$role;
        $this->roleID=$roleID;
    }
}

class Admin extends user{
    function __construct($firstname,$lastname,$Email,$password,$role,$roleID){
        parent::__construct($firstname,$lastname,$Email,$password,$role,$roleID);
    }
}

class Student extends user{
    private $conn;
    public function __construct($DBconn){
        $this->conn = $DBconn;
    }

   public function getAllstudents(){
    $sql="SELECT * FROM students";
    $result=$this->conn->query($sql);
    return $result;
   }

   public function getStudentByID($ID) {
    $sql = "SELECT * FROM students WHERE ID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        return $result->fetch_assoc();  // Fetch data as an associative array
    } else {
        return null;  // Return null if no record is found
    }
    $query->close();
    $mysqli->close();
    exit;
}
}

class Doctor extends user{
    public $faculty;
    public $course_code;

    function __construct($firstname,$lastname,$Email,$password,$role,$roleID,$faculty,$course_code){
        parent::__construct($firstname, $lastname, $Email, $password, $role,$roleID); 
          $this->faculty=$faculty;
          $this->course_code=$course_code;
     }
}

class TA extends user{
    public $faculty;
    public $course_code;
    function __construct($firstname,$lastname,$Email,$password,$role,$roleID,$faculty,array $assigned_doctors,$course_code){
        parent::__construct($firstname, $lastname, $Email, $password, $role,$roleID);   
        $this->faculty=$faculty;
        $this->course_code=$course_code;
     }
}

class Schedule{
    public $S_ID;
    public $course_name;
    public $course_code;
    public $D_ID;
    public $Slots;
    function __construct($S_ID,$course_name,$course_code,$D_ID,$Slots){
        $this->S_ID=$S_ID;
        $this->course_name=$course_name;
        $this->course_code=$course_code;
        $this->D_ID=$D_ID;
        $this->Slots=$Slots;
    }
    


}

?>