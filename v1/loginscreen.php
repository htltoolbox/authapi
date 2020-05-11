<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/v1/include/header.php';

?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

function valid($pattern,$data){
	$matches = preg_match($pattern,$data);
	if($matches == 0) return false;
	return true;
}

function validEmail($email){
	$pattern = '/^([A-z]+\.[A-z]+(\d\d)?@htl-salzburg.ac.at)$/';
	return valid($pattern,$email);
}

function validPw($pw){
	//pw has to be longer than 4
	if(count(str_split($pw))<=4){
		return false;
	}
	return true;
}

$eamil = $password = "";
$emailErr = $passwordErr = "";

error_reporting(E_ALL ^ E_NOTICE);  

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$apikey = 'meEujVdn64YtSSxFKryiRADLZ2fMi6NU';

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} 
	else {
		if(validEmail($_POST["email"]))	$email = $_POST["email"];
	}

	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} 
	else
	{
		if(validPw($_POST["password"])){
		$password =  htmlspecialchars($_POST["password"]);
		}
	}



	$json = file_get_contents("https://api.philsoft.at/v1/login.php?api_key=meEujVdn64YtSSxFKryiRADLZ2fMi6NU&email=philipp.lackinger02@htl-salzburg.ac.at&password=12345");

	$result = json_decode($json);

	echo '<br>';
	echo "HTTP Response code: " . $result->code;
	echo '<br>';
	echo "Token: " . $result->token;
	echo '<br>';

	if($result->code == 200){
		$_SESSION['user_token'] = $result->token; 
		echo "session was set to " . $result->token;
	}

}

?>

<h2>Toolbox OAuth</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Passwort: <input type="password" name="password" value="<?php echo $password;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">  
</form>

<?php
	echo $email;
	echo "<br>";
	echo $password;
	echo "<br>";
	echo $result->token;
?>

</body>
</html>