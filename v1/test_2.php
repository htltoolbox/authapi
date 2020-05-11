<?php




$json = file_get_contents("https://api.philsoft.at/v1/login.php?api_key=meEujVdn64YtSSxFKryiRADLZ2fMi6NU&email=philipp.lackinger02@htl-salzburg.ac.at&password=12345");

$result = json_decode($json);

echo $result->code;
echo $result->token;

?>