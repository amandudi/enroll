<?php
class dbmodel
{
	/**
	 * will contain database connection
	 */
	private $_host = 'localhost';	
	private	$_name = 'college';
	private $_user = 'root';
	private	$_pass = '';	
	protected $_con;
	public $errors = array();
	/**
	 * Initalize DBclass
	 */
	public function __construct()
	{
		$this->_con = mysqli_connect($this->_host, $this->_user, $this->_pass, $this->_name);
		if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	/**
	 * this will enroll new student
	 * @param array $data
	 * @return boolean true or false
	 */

	public function enroll($data){
		$student_exists = $this->find($data['email']);
		if($student_exists) {
			return $this->errors;
		}
		// Escape variables for security
		$name = mysqli_real_escape_string( $this->_con, trim( $data['name'] ) );
		$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );
		$phone = mysqli_real_escape_string( $this->_con, trim( $data['phone'] ) );
		$insert_query = "INSERT INTO student_table (name, email, phone) VALUES ('$name', '$email', $phone)";
		if(mysqli_query($this->_con, $insert_query)){
			return true;
		}else{
			array_push($this->errors, "Unknown error, please try again later - ".mysqli_error($this->_con));
			return $this->errors;
		}
	}

	public function find($email){
		if(!$email){ return; }
		$email = mysqli_real_escape_string( $this->_con, trim( $email ) );
		$find_query = "select id from student_table where email = '$email'";
		if($qry_result = mysqli_query($this->_con, $find_query)){
			$student = mysqli_num_rows($qry_result);
			if($student > 0){
				array_push($this->errors, "A student with the same email already exists");
				return true;
			}
		}
		return false;
	}
}
$db_obj = new dbmodel();

?>