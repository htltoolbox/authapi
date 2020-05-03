<?php

$api_key = $_GET['api_key'];
$userId = $_GET['userId'];
$password = $_GET['password'];

if(!isset($api_key)){
    echo json_encode(
        array(
            'code' => 403,
            'message' => 'No API Key given'
        )
    );

    die();
} 

else{

    include $_SERVER['DOCUMENT_ROOT'] . '/v1/include/init.php';

    $q = $conn->query("SELECT `date_generated` FROM api_keys WHERE api_key = '$api_key' AND permission >= 2");

    if($q->num_rows == 0){
        echo json_encode(
            array(
                'code' => 403,
                'message' => 'API is not valid'
            )
        );  

        die();
    }

    $d_generated = $q->fetch_assoc()['date_generated'];
    $d_expires = strtotime($d_generated . '+365 days');
    $d_today = strtotime($date);

    if($d_today >= $d_expires){
        $conn->query("UPDATE api_keys SET is_valid = 0 WHERE api_key = '$api_key'");
    }

    if(!isset($userId)){
        echo json_encode(
            array(
                'code' => 403,
                'message' => 'user_id is requiered'
            )
        );

        die();
    }

    if(!isset($password)){
        echo json_encode(
            array(
                'code' => 403,
                'message' => 'password is requiered'
            )
        );

        die();
    }

    $q = $conn->query("SELECT hash FROM finaluser WHERE userId = $userId");

    if($q->num_rows == 0){
        echo json_encode(
            array(
                'code' => 404,
                'message' => 'user does not exist'
            )
        );  
    }

    $user = $q->fetch_object();

    if(password_verify($password,$user->hash)){
        echo "passwords match";

        $q = $conn->query("UPDATE fianlusers WHERE userId = $userId SET api_key= ."hash("sha256",rand()));
    }

    

    


}