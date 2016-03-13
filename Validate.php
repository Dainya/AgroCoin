<?php

class Validate {

	public function __construct()
	{

	}


	public function isEmail($val)
	{
		if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {

			return false;
		}

		return true;
	}



	public function isNull($val)
	{
		if($val==null)
			return true;
		return false;
	}



}



?>

<?php

	  $containsDigit   = preg_match('/\d/', $Password); // check if contains digit
      $containsSpecial = preg_match('/[^a-zA-Z\d]/', $Password); // check if contains special characters
      $containsLower = preg_match('/[^A-Z\d!@#$%^&*()_+{}?><~`.,-=]/', $Password); // check if contains lower case
      $containsUpper = preg_match_all('/[^a-z\d!@#$%^&*()_+{}?><~`.,-=]/', $Password,$uppercase_match); // check if contains upper case
            $ctr = 0;
            
          if(!$containsDigit){// if its not containsDigit then print a message saying so
            $errors[] ="<br><span style=color: #D8000C>- Password must contain atleast one number.</span>";
            $ctr++;
            //1^%&dDDD85
            //updated one 1^%&dDDD81
          }

          if(!$containsSpecial){// if its not containsSpecial then print a message saying so
            $errors[] = "<br><span style=color: #D8000C>- Password must contain at least one special character.</span>";
            $ctr++;
            
          }

          if(!$containsLower){ // if its not containsLower then print a message saying so
            $errors[] = "<br><span style=color: #D8000C>- Password must contain one lowercase</span>";
            $ctr++;
            
          }
  

          if(count($uppercase_match[0])  <  3){// if the variable uppercase_match is less than 3, then print a message saying so
            $errors[] = "<br><span style=color: #D8000C>- Password must contain three uppercase</span>";
            $ctr++;
          
          }

          if(strpos($Password," ")){// if password containes space
            $errors[] = "<br><span style=color: #D8000C>- Password must not contain spaces</span>";
            $ctr++;
          
          }

          if(strlen($Password) < 8 || strlen($Password) > 16){ //checking length if its between 8 and 16, is not print appropriate message
            $errors[] = "<br><span style=color: #D8000C>- Password must be between 8-16 characters</span>";
                $ctr++;
              
          }

?>

