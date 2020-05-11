<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/v1/include/header.php';

$token = $_SESSION['user_token'];
echo '<br>';
echo 'Token= ' . $token;

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

echo '<br>';
echo 'initialized Database Connection';

try{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM finaluser WHERE api_key = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch_row();
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

echo json_encode(
    array(
        'code' => 200,
        'userId' => $result->userId,
        'email' => $result->email,
        'vorname' => $result->vorname,
        'nachname' => $result->nachname,
        'klasse' => $result->klasse,
        'rechte' => $result->rechte,
        'aktiv' => $result->aktiev
    )
);

$stmt->close();
    
?>