<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/v1/include/header.php';


$token = $_GET['token'];

if(!isset($token)){
    echo json_encode(
        array(
            'code' => 403,
            'message' => 'Token Missing'
        )
    );
    die();
}
else{
    include $_SERVER['DOCUMENT_ROOT'] . '/v1/include/init.php';

    if($stmt = $conn->prepare("SELECT * FROM finaluser WHERE token = ?")){
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->bind_result($user);
        $stmt->fetch();
        echo $user;
        $stmt->close();
    }
}

?>