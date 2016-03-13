<?php  


$mysqli = new mysqli ('localhost', 'root', '', 'registrationdatabase' );
 

 /*creating a function so that users name can be 
 displayed once they are logged in to their accounts.*/

 function getUsersData($UserID)
 {

$array = array();
$query = mysqli_query("SELECT * FROM  'user' WHERE 'UserID' ='".$UserID."'" );
while($row = mysqli_fetch_assoc($query))
	{

		$array['UserID'] = $row['UserID'];
		$array['Fname'] = $row['Fname'];
		$array['Lname'] = $row['Lname'];
		$array['Email'] = $row['Email'];
		$array['Password'] = $row['Password'];
	}
	return $array;

 }

function getId($Username){
$query = mysqli_query("SELECT 'UserID' FROM  user WHERE 'Username' =".$Username);
while($row = mysqli_fetch_assoc($query))
	{

		return $row['UserID'];
	}
}
?>