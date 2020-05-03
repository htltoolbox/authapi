<?php

	function genrateNewHash(){
		$hash = "";
		$rnd = rand(20,30);
		for($i = 0; $i< $rnd;$i++){
			$hash .= rand(0,9);
		}
		return $hash;
	}

?>