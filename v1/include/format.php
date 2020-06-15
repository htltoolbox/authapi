<?php

	function valid($pattern,$data){
		$matches = preg_match($pattern,$data);
		if($matches == 0) return false;
		return true;
	}

	function invalidLetters($text){
		$pattern = '/[<>=$]/';
		return valid($pattern,$text);
	}

	function validPw($pw){
		//pw has to be longer than 4
		if(count(str_split($pw))<=4){
			return false;
		}
		return true;
    }
	
	function validEmail($email){
        $pattern = '/^([A-z]+\.[A-z]+(\d\d)?@htl-salzburg.ac.at)$/';
        return valid($pattern,$email);
    }
	
	function validKlasse($klasse){
		$pattern = "/^([1-8][A-I]([A-Z]{2,4})|(LEHRER))$/";
		return valid($pattern,$klasse);
	}
	
	function validNavNr($text){
		$pattern = "/^E[1-9]+ \d\d\/\d\d-[1-9]+$/";
		return valid($pattern,$text);
	}
	
	function isInt($input){
		$pattern = "/^[1-9]+$/";
		return valid($pattern,$input);
	}

	function isBrd($name){
		$pattern = "/^.+\.brd$/";
		return valid($pattern,$name);
	}

	function isSch($name){
		$pattern = "/^.+\.sch$/";
		return valid($pattern,$name);
	}

	function validFileName($name){
		$pattern = "/.+|.+/";
		return valid($pattern,$name);
	}


?>