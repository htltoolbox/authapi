<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/v1/include/header.php';

echo "Session Token = " . $_SESSION['user_token'];


echo "Rakic Password: " . password_hash("12345",PASSWORD_DEFAULT);

?>