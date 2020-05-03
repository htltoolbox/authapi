<?php

    $user_id = $_GET['user_id'];
    $api_key = $_GET['api_key'];
    $fields = $_GET['fields'];

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

        include $_SERVER['DOCUMENT_ROOT'] . '/include/init.php';

        $q = $conn->query("SELECT date_generated FROM api_keys WHERE api_key = '$api_key' AND is_valid = 1");

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
        $d_expires = strtotime($d_generated . '+7 days');
        $d_today = strtotime($date);

        if($d_today >= $d_expires){
            $conn->querry("UPDATE api_keys SET is_valid = 0 WHERE api_key = '$api_key'");
        }

        if(!isset($user_id)){
            echo json_encode(
                array(
                    'code' => 403,
                    'message' => 'user_id is requiered'
                )
            );

            die();
        }

        $q = $conn->query("SELECT * FROM user_discord WHERE USER_ID = '$user_id'");

        if($q->num_rows == 0){
            echo json_encode(
                array(
                    'code' => 404,
                    'message' => 'user does not exist'
                )
            );

            die();
        }
        if(!isset($fields)){
            echo json_encode($q->fetch_assoc());
            die();
        }

        $fields = explode(',', $fields);

        $allowed = array(
            'USER_ID',
            'USER_EMAIL',
            'USER_NAME',
            'USER_FULLNAME',
            'USER_LASTNAME',
            'USER_BIRTHYEAR',
            'USER_CLASS',
            'USER_AUTHTOKEN',
            'USER_DISCORDTAG'
        );

        $user = array();

        $q = $conn->query("SELECT * FROM user_discord WHERE USER_ID = '$user_id'")->fetch_assoc();

        foreach($fields as $field){
            if(!in_array($field, $allowed)){
                echo json_encode(
                    array(
                        'code' => 404,
                        'message' => 'field does not exist'
                    )
                );
    
                die();
            }

            if($field == 'USER_FULLNAME'){
                $user[$field] = $q['USER_NAME']. ' ' . $q['USER_LASTNAME'];
                continue;
            }

            $user[$field] = $q[$field];

            

        }

        print_r(
            json_encode(
                $user
            )
        );



    }

?>