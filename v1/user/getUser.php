<?php
header('Content-Type: application/json');
error_reporting(E_ALL ^ E_NOTICE);  

include_once $_SERVER['DOCUMENT_ROOT'] . '/v1/include/header.php';

$token = htmlspecialchars($_SESSION['user_token']);

if(!isset($token)){
    echo json_encode(
        array(
            'code' => 403,
            'message' => 'Token Missing'
        )
    );
    die();
}

include $_SERVER['DOCUMENT_ROOT'] . '/v1/include/init.php';

$SQL = "SELECT * FROM finaluser WHERE api_key = ?;";
$stmt = mysqli_stmt_init($conn);
    

if(!mysqli_stmt_prepare($stmt, $SQL)){
    echo "SQL-Error: binding of parameters failed";
}else{
    mysqli_stmt_bind_param($stmt, "s", $token);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_object($result);

    echo json_encode(
        array(
            'code' => 200,
            'userId' => $row->userId,
            'email' => $row->email,
            'vorname' => $row->vorname,
            'nachname' => $row->nachname,
            'klasse' => $row->klasse,
            'rechte' => $row->rechte,
            'aktiv' => $row->aktiev
        )
    );
    
}

$conn->close();
    
?>