<?php

class updateValidator {

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

